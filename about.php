<?php require_once 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>عن المنصة - SADS</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="nav-logo">نظام <span>SADS الإغاثي</span></a>
        <div class="nav-links">
            <a href="index.php">الرئيسية</a>
            <a href="about.php" class="active">عن المنصة</a>
            <a href="requests.php">طلبات الاحتياج</a>
            <a href="contact.php">تواصل معنا</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" style="color:#ff4d4d;">تسجيل خروج</a>
            <?php else: ?>
                <a href="login.php" class="nav-cta">دخول المنظمات</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-hero">
        <h1>حول نظام SADS الإغاثي</h1>
        <p>رؤيتنا ورسالتنا لتسهيل وتنسيق إيصال المساعدات الإنسانية في جميع أنحاء السودان</p>
    </div>

    <div class="container" style="max-width:850px;">
        <div style="background:white; padding:35px; border-radius:12px; box-shadow:var(--shadow); line-height:1.8;">
            <h2 style="color:var(--primary-color); margin-bottom:15px;">💡 رؤية المشروع</h2>
            <p style="margin-bottom:20px; color:var(--text-dark);">
                تأسس نظام <strong>SADS (Sudan Aid Distribution System)</strong> كاستجابة رقمية سريعة وموثوقة للاحتياجات الإنسانية للنازحين. يهدف النظام للحد من العشوائية في توزيع الدعم، والتركيز على المناطق الأكثر تضرراً من خلال بيانات محدثة ولحظية.
            </p>

            <h2 style="color:var(--primary-color); margin-bottom:15px;">🎯 كيف يعمل النظام؟</h2>
            <ul style="padding-right:20px; margin-bottom:25px; color:var(--text-muted);">
                <li><strong>الجهات المنسقة بالميدان:</strong> تقوم برفع الطلبات المستعجلة (غذاء، دواء، خيم، مياه).</li>
                <li><strong>غرفة العمليات:</strong> تقوم بمراجعة وتحديد درجة أولوية كل طلب.</li>
                <li><strong>المنظمات والداعمون:</strong> يستعرضون الطلبات الموثقة ويقومون بتوجيه القوافل مباشرة.</li>
            </ul>

            <div style="text-align:center; margin-top:30px;">
                <a href="signup.php" class="btn btn-primary">انضم كمنظمة إغاثية أو جهة منسقة</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>