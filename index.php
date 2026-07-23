<?php require_once 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SADS - نظام المساعدات الإنسانية للنازحين في السودان</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="nav-logo">نظام <span>SADS الإغاثي</span></a>
        <div class="nav-links">
            <a href="index.php" class="active">الرئيسية</a>
            <a href="about.php">عن المنصة</a>
            <a href="requests.php">طلبات الاحتياج</a>
            <a href="contact.php">تواصل معنا</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="add_request.php" class="btn btn-primary" style="padding:4px 10px;">+ إضافة طلب</a>
                <a href="logout.php" style="color:#ff4d4d;">تسجيل خروج (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a>
            <?php else: ?>
                <a href="login.php" class="nav-cta">دخول المنظمات</a>
            <?php endif; ?>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>نظام إدارة وتوزيع المساعدات <br /><span style="color:var(--accent-light);">للنازحين في السودان (SADS)</span></h1>
            <p>منصة رقمية موحدة لتنسيق العمل الإغاثي وتوجيه المساعدات للمناطق الأكثر احتياجاً بكل شفافية</p>
            <div style="display:flex; gap:15px; justify-content:center; flex-wrap:wrap;">
                <a href="requests.php" class="btn btn-primary">📦 عرض قائمة الاحتياجات</a>
                <a href="about.php" class="btn" style="background:white; color:var(--primary-color);">ℹ️ تعرف على المنصة</a>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 style="text-align:center; color:var(--primary-color); margin-bottom:30px;">🌟 أهداف المنصة</h2>
        <div class="grid-container">
            <div class="card" style="border-top-color:var(--accent-light);">
                <h3 class="card-title">📍 التنسيق الولائي</h3>
                <p class="card-meta">ربط جميع مراكز الإيواء والمستشفيات الميدانية بالولايات مباشرة مع المنظمات المانحة.</p>
            </div>
            <div class="card" style="border-top-color:var(--accent-color);">
                <h3 class="card-title">⚖️ ترتيب الأولويات</h3>
                <p class="card-meta">تصنيف الاحتياجات الإغاثية آلياً حسب الخطورة وعدد النازحين المتأثرين.</p>
            </div>
            <div class="card" style="border-top-color:var(--primary-color);">
                <h3 class="card-title">🤝 الشفافية السرعة</h3>
                <p class="card-meta">تسريع استجابة القوافل والحد من التكرار أو النقص في تغطية المناطق المنكوبة.</p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
        <p>🇸🇩 معاً لإغاثة أهلنا في كل ولايات السودان</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>