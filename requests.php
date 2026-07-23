<?php
require_once 'config/db.php';

// جلب جميع الطلبات من قاعدة البيانات
$stmt = $pdo->query("SELECT aid_requests.*, users.organization FROM aid_requests LEFT JOIN users ON aid_requests.user_id = users.id ORDER BY created_at DESC");
$requests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>طلبات الاحتياجات - SADS</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="nav-logo">نظام <span>SADS الإغاثي</span></a>
        <div class="nav-links">
            <a href="index.php">الرئيسية</a>
            <a href="about.php">عن المنصة</a>
            <a href="requests.php" class="active">طلبات الاحتياج</a>
            <a href="contact.php">تواصل معنا</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" style="color:#ff4d4d;">تسجيل خروج</a>
            <?php else: ?>
                <a href="login.php" class="nav-cta">دخول المنظمات</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-hero">
        <h1>📊 طلبات الاحتياجات الإغاثية بالولايات</h1>
        <p>استعراض وتحليل الاحتياجات العاجلة للنازحين المرفوعة من الميدان</p>
    </div>

    <section class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:15px;">
            <input type="text" id="searchRequest" placeholder="🔍 ابحث باسم الولاية أو نوع المساعدة..." style="padding:10px 15px; border-radius:6px; border:1px solid #ccc; width:100%; max-width:350px;" />
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="add_request.php" class="btn btn-primary">➕ تقديم طلب احتياج جديد</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">🔒 سجل دخولك لتقديم طلب جديد</a>
            <?php endif; ?>
        </div>

        <?php if(count($requests) > 0): ?>
            <div class="grid-container">
                <?php foreach($requests as $req): ?>
                    <div class="card request-card">
                        <div>
                            <div class="card-header">
                                <span class="card-meta">📍 <?= htmlspecialchars($req['state_name']) ?></span>
                                <?php 
                                    $pClass = 'priority-low'; $pText = 'أولوية عادية';
                                    if($req['priority'] === 'high') { $pClass = 'priority-high'; $pText = 'أولوية قصوى'; }
                                    elseif($req['priority'] === 'medium') { $pClass = 'priority-medium'; $pText = 'أولوية متوسطة'; }
                                ?>
                                <span class="badge-priority <?= $pClass ?>"><?= $pText ?></span>
                            </div>
                            <h3 class="card-title"><?= htmlspecialchars($req['aid_type']) ?></h3>
                            <div class="card-meta">
                                <p><strong>👥 عدد الأسر المتضررة:</strong> <?= htmlspecialchars($req['families_count']) ?> أسرة</p>
                                <p><strong>🏢 الجهة المنسقة:</strong> <?= htmlspecialchars($req['organization'] ?? 'جهات محلية') ?></p>
                                <p><strong>📞 التواصل:</strong> <?= htmlspecialchars($req['contact_info']) ?></p>
                                <?php if(!empty($req['details'])): ?>
                                    <p style="margin-top:8px; background:#f1f1f1; padding:8px; border-radius:4px;">💬 <?= htmlspecialchars($req['details']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button class="btn btn-primary" style="width:100%; margin-top:10px;" onclick="alert('تم إرسال إشعار لغرفة العمليات لتوفير الدعم لهذا الطلب.')">🤝 تقديم الدعم والرعاية</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align:center; color:var(--text-muted); margin:40px 0;">لا توجد طلبات احتياج مسجلة حالياً.</p>
        <?php endif; ?>
    </section>

    <footer class="footer">
        <p>نظام توزيع المساعدات للنازحين في السودان <span>(SADS)</span> © 2026</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>