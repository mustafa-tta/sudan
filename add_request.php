<?php
require_once 'config/db.php';

// حماية الصفحة للمستخدمين المسجلين فقط
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $state_name = trim($_POST['state_name']);
    $aid_type = trim($_POST['aid_type']);
    $priority = trim($_POST['priority']);
    $families_count = intval($_POST['families_count']);
    $contact_info = trim($_POST['contact_info']);
    $details = trim($_POST['details']);

    if (!empty($state_name) && !empty($aid_type) && !empty($contact_info) && $families_count > 0) {
        $stmt = $pdo->prepare("INSERT INTO aid_requests (user_id, state_name, aid_type, priority, families_count, contact_info, details) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$_SESSION['user_id'], $state_name, $aid_type, $priority, $families_count, $contact_info, $details])) {
            header("Location: requests.php");
            exit();
        } else {
            $error = 'حدث خطأ في حفظ الطلب!';
        }
    } else {
        $error = 'يرجى إدخال جميع البيانات المطلوبة بشكل صحيح.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة طلب احتياج - SADS</title>
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
            <a href="logout.php" style="color:#ff4d4d;">تسجيل خروج</a>
        </div>
    </nav>

    <div class="page-hero">
        <h1>📝 رفع طلب احتياج إغاثي جديد</h1>
        <p>أدخل البيانات الدقيقة لضمان سرعة الاستجابة من المنظمات الداعمة</p>
    </div>

    <div class="container" style="max-width: 600px;">
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow);">
            
            <?php if($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="add_request.php" method="POST">
                <div class="form-group">
                    <label>الولاية / المنطقة / اسم المعسكر</label>
                    <input type="text" name="state_name" placeholder="مثال: ولاية كسلا - معسكر خشم القربة" required />
                </div>
                <div class="form-group">
                    <label>نوع المساعدات المطلوبة</label>
                    <select name="aid_type" required>
                        <option value="">اختر النوع...</option>
                        <option value="سلال غذائية ومواد تموينية">سلال غذائية ومواد تموينية</option>
                        <option value="خيم ومستلزمات إيواء">خيم ومستلزمات إيواء</option>
                        <option value="أدوية ومستلزمات طبية">أدوية ومستلزمات طبية</option>
                        <option value="مياه صالحة للشرب وإصحاح بيئي">مياه صالحة للشرب وإصحاح بيئي</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>درجة الأولوية والخطورة</label>
                    <select name="priority" required>
                        <option value="high">أولوية قصوى (حالة عاجلة جداً)</option>
                        <option value="medium" selected>أولوية متوسطة</option>
                        <option value="low">أولوية عادية</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>عدد الأسر النازحة المستفيدة</label>
                    <input type="number" name="families_count" placeholder="مثال: 250" required min="1" />
                </div>
                <div class="form-group">
                    <label>رقم هاتف مسؤول التواصل بالميدان</label>
                    <input type="text" name="contact_info" placeholder="مثال: 0912345678" required />
                </div>
                <div class="form-group">
                    <label>تفاصيل إضافية ووصف الوضع الإنساني</label>
                    <textarea name="details" rows="4" placeholder="اكتب وصفاً مختصراً للظروف في المنطقة..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">💾 إرسال الطلب للنظام</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>