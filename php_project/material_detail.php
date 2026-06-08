<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: materials.php");
    exit;
}

// Fetch material
$stmt = $pdo->prepare("SELECT m.*, c.name as category_name FROM materials m JOIN categories c ON m.category_id = c.id WHERE m.id = ?");
$stmt->execute([$id]);
$material = $stmt->fetch();

if (!$material) {
    header("Location: materials.php");
    exit;
}

// Fetch related materials
$rel_stmt = $pdo->prepare("SELECT * FROM materials WHERE category_id = ? AND id != ? LIMIT 3");
$rel_stmt->execute([$material['category_id'], $id]);
$related_materials = $rel_stmt->fetchAll();

$page_title = $material['name'] . ' — NERMAN.AI';
$body_class = 'bg-[#0056D2] text-white';
$hide_header = true;
$hide_footer = true;

include 'includes/header.php';
?>

<style>
    body {
        background: linear-gradient(180deg, #001F3F 0%, #157BFF 100%) !important;
        background-attachment: fixed !important;
        color: white !important;
        min-height: 100vh;
    }

    .detail-container {
        padding: 10px 20px;
        max-width: 500px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .back-btn {
        font-size: 24px;
        color: white;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        padding: 5px;
    }

    .preview-card {
        background: #1877F2;
        border-radius: 32px;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
    }

    .preview-main {
        aspect-ratio: 1 / 1;
        background: #001F3F;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-main img,
    .preview-main video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .heart-btn {
        position: absolute;
        bottom: 15px;
        right: 15px;
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        cursor: pointer;
        transition: 0.3s;
    }

    .heart-btn i {
        color: white;
        font-size: 18px;
    }

    .info-footer {
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-title {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .info-menu {
        font-size: 24px;
        opacity: 0.8;
    }

    .section-label {
        font-size: 14px;
        font-weight: 700;
        color: white;
        opacity: 0.9;
        margin-bottom: 15px;
        margin-top: 25px;
        display: block;
    }

    .download-btn {
        width: 100%;
        background: #003380;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 20px;
        color: white;
        font-size: 24px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        cursor: pointer;
        transition: 0.3s;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .download-btn:active {
        transform: scale(0.98);
        background: #002255;
    }

    .tags-container {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .tag {
        background: rgba(255, 255, 255, 0.1);
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        padding: 12px 25px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        color: white;
        white-space: nowrap;
    }

    .author-section {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        padding-top: 20px;
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-name {
        font-weight: 700;
        font-size: 16px;
        display: block;
        color: white;
    }

    .author-stats {
        font-size: 11px;
        color: white;
        opacity: 0.8;
    }

    .follow-btn {
        background: #1877F2;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }
</style>

<div class="detail-container">
    <a href="javascript:history.back()" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <div class="preview-card">
        <div class="preview-main">
            <?php
            $media_url = $material['image_url'];
            $is_video = str_ends_with($media_url, '.mp4') || str_ends_with($media_url, '.mov') || str_ends_with($media_url, '.webm');
            if ($is_video): ?>
                <video src="<?php echo $media_url; ?>" autoplay muted loop playsinline></video>
            <?php else: ?>
                <img src="<?php echo $media_url; ?>" alt="<?php echo $material['name']; ?>">
            <?php endif; ?>

            <div class="heart-btn">
                <i class="fa-solid fa-heart"></i>
            </div>
        </div>
        <div class="info-footer">
            <span class="info-title"><?php echo $material['name']; ?></span>
            <span class="info-menu"><i class="fa-solid fa-ellipsis-vertical"></i></span>
        </div>
    </div>

    <?php if (is_authenticated() && get_user_subscription() == 'Pro'): ?>
        <a href="<?php echo $media_url; ?>" download class="download-btn">
            <i class="fa-solid fa-download"></i> Скачать
        </a>
    <?php else: ?>
        <a href="https://t.me/kucherbaev_17" target="_blank" class="download-btn" style="font-size: 18px;">
            <i class="fa-solid fa-download"></i> Купить PRO для скачивания
        </a>
    <?php endif; ?>

    <span class="section-label">Рекомендации</span>
    <div class="tags-container">
        <div class="tag">Selection</div>
        <div class="tag">UI Elements</div>
        <div class="tag">VFX</div>
    </div>

    <span class="section-label">Автор</span>
    <div class="author-section">
        <div class="author-info">
            <img src="/static/img/avatar-baxtiyorov.png" alt="Author" class="author-avatar"
                onerror="this.src='/static/img/avatar-placeholder.png'">
            <div>
                <span class="author-name">Baxtiyorov</span>
                <span class="author-stats">Ещё 12 его работ...</span>
            </div>
        </div>
        <a href="#" class="follow-btn">Подписаться</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>