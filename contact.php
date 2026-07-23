<?php
require_once 'config/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject_type = trim($_POST['subject_type']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, phone, subject_type, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $phone, $subject_type, $message])) {
            $success = 'تم إرسال رسالتك بنجاح لغرفة عمليات النظام وسيتم التواصل معك.';
        } else {
            $error = 'حدث خطأ أثناء الإرسال!';
        }
    } else {
        $error = 'يرجى تعبئة الحقول الأساسية.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تواصل معنا - SADS</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="nav-logo">نظام <span>SADS الإغاثي</span></a>
        <div class="nav-links">
            <a href="index.php">الرئيسية</a>
            <a href="about.php">عن المنصة</a>
            <a href="requests.php">طلبات الاحتياج</a>
            <a href="contact.php" class="active">تواصل معنا</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" style="color:#ff4d4d;">تسجيل خروج</a>
            <?php else: ?>
                <a href="login.php" class="nav-cta">دخول المنظمات</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-hero">
        <h1>📞 تواصل مع غرفة العمليات الإغاثية</h1>
        <p>استقبال الاستفسارات، الشراكات الإنسانية، والبلاغات العاجلة</p>
    </div>

    <section class="container" style="max-width: 650px;">
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow);">
            
            <?php if($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label>الاسم / الجهة</label>
                    <input type="text" name="name" required placeholder="مثال: د. محمد - الهلال الأحمر" />
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" required placeholder="name@domain.com" />
                </div>
                <div class="form-group">
                    <label>رقم الهاتف / الواتساب</label>
                    <input type="text" name="phone" required placeholder="0912345678" />
                </div>
                <div class="form-group">
                    <label>نوع الموضوع</label>
                    <select name="subject_type" required>
                        <option value="استفسار عام">استفسار عام</option>
                        <option value="تنسيق شراكة إغاثية">تنسيق شراكة إغاثية</option>
                        <option value="بلاغ عن حالة إنسانية حرجة">بلاغ عن حالة إنسانية حرجة</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>تفاصيل الرسالة</label>
                    <textarea name="message" rows="4" required placeholder="اكتب رسالتك هنا..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">📤 إرسال الرسالة</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>