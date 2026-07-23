<?php
require_once 'config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $organization = trim($_POST['organization']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($email) && !empty($password) && !empty($organization)) {
        // التحقق من تكرار البريد
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = 'البريد الإلكتروني مسجل بالفعل!';
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $insertStmt = $pdo->prepare("INSERT INTO users (name, email, password, organization) VALUES (?, ?, ?, ?)");
            
            if ($insertStmt->execute([$name, $email, $hashed_password, $organization])) {
                $success = 'تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول.';
            } else {
                $error = 'حدث خطأ أثناء إنشاء الحساب، يرجى المحاولة لاحقاً.';
            }
        }
    } else {
        $error = 'جميع الحقول مطلوبة!';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إنشاء حساب جديد - SADS</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="nav-logo">نظام <span>SADS الإغاثي</span></a>
        <div class="nav-links">
            <a href="index.php">الرئيسية</a>
            <a href="about.php">عن المنصة</a>
            <a href="requests.php">طلبات الاحتياج</a>
            <a href="contact.php">تواصل معنا</a>
        </div>
    </nav>

    <div class="container" style="max-width: 500px; margin-top: 40px;">
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow);">
            <h2 style="color: var(--primary-color); text-align: center; margin-bottom: 8px;">تسجيل حساب جديد</h2>
            <p style="color: var(--text-muted); text-align: center; margin-bottom: 20px;">انضم كمنظمة إغاثية أو جهة منسقة</p>

            <?php if($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label>الاسم الكامل لممثل الجهة</label>
                    <input type="text" name="name" required placeholder="مثال: د. أحمد عبد الله" />
                </div>
                <div class="form-group">
                    <label>اسم المنظمة / المبادرة</label>
                    <input type="text" name="organization" required placeholder="مثال: منظمة الإغاثة الوطنية" />
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني الرسمى</label>
                    <input type="email" name="email" required placeholder="name@domain.org" />
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" required placeholder="••••••••" />
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">تسجيل الحساب</button>
            </form>
            
            <p style="text-align: center; margin-top: 20px; font-size: 0.9rem;">
                لديك حساب بالفعل؟ <a href="login.php" style="color: var(--accent-color); font-weight: bold;">تسجيل الدخول</a>
            </p>
        </div>
    </div>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>