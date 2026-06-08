<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

if (!is_authenticated()) {
    header("Location: login.php");
    exit;
}

// Fetch all categories
$cat_stmt = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
$all_categories = $cat_stmt->fetchAll();

// Get active identifiers from GET
$active_slug = $_GET['cat'] ?? null;
$active_name = $_GET['sub'] ?? null;

$materials = [];
$display_name = "Материалы";

if ($active_slug) {
    // Fetch by slug
    $mat_stmt = $pdo->prepare("SELECT m.*, c.name as category_name FROM materials m JOIN categories c ON m.category_id = c.id WHERE c.slug = ?");
    $mat_stmt->execute([$active_slug]);
    $materials = $mat_stmt->fetchAll();

    // Get display name
    foreach ($all_categories as $c) {
        if ($c['slug'] == $active_slug) {
            $display_name = $c['name'];
            break;
        }
    }
} elseif ($active_name) {
    // Fetch by name
    $mat_stmt = $pdo->prepare("SELECT m.*, c.name as category_name FROM materials m JOIN categories c ON m.category_id = c.id WHERE c.name = ?");
    $mat_stmt->execute([$active_name]);
    $materials = $mat_stmt->fetchAll();
    $display_name = $active_name;
} else {
    // Default: Show first available small category if none selected
    if (!empty($all_categories)) {
        $default_cat = null;
        foreach ($all_categories as $c) {
            if (!in_array($c['slug'], ['transitions', 'backgrounds', 'sounds'])) {
                $default_cat = $c;
                break;
            }
        }
        if (!$default_cat)
            $default_cat = $all_categories[0];

        $active_slug = $default_cat['slug'];
        $display_name = $default_cat['name'];

        $mat_stmt = $pdo->prepare("SELECT m.*, c.name as category_name FROM materials m JOIN categories c ON m.category_id = c.id WHERE c.id = ?");
        $mat_stmt->execute([$default_cat['id']]);
        $materials = $mat_stmt->fetchAll();
    }
}

$page_title = 'Материалы — NERMAN.AI';
$body_class = 'deep-blue-theme text-white';
$hide_header = true;
$hide_footer = true;

include 'includes/header.php';
?>

<style>
    body {
        background-color: #0056D2 !important;
        color: white !important;
    }

    .materials-wrap {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px 15px;
        min-height: 100vh;
    }

    /* Custom Header */
    .m-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 15px;
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        border-radius: 15px;
        margin-bottom: 25px;
        background: rgba(255, 255, 255, 0.05);
    }

    .m-header-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: white;
    }

    /* Category Popup Overlay */
    #category-popup-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        z-index: 2000;
        transition: opacity 0.3s ease;
    }

    #category-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 320px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 40px;
        padding: 30px 20px;
        z-index: 2001;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .cat-popup-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 14px 24px;
        margin-bottom: 15px;
        background: #156BF0;
        color: white;
        border-radius: 50px;
        font-weight: 800;
        font-size: 16px;
        text-decoration: none !important;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(21, 107, 240, 0.3);
    }

    .cat-popup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(21, 107, 240, 0.4);
        background: #1059C8;
    }

    .cat-popup-btn:last-child {
        margin-bottom: 0;
    }

    .m-header-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        color: white;
        text-decoration: none;
    }

    .m-header-icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Search & Menu Bar */
    .search-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        position: relative;
    }

    .search-box {
        flex-grow: 1;
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 12px 20px;
    }

    .search-input {
        background: transparent;
        border: none;
        color: white;
        font-size: 14px;
        margin-left: 10px;
        width: 100%;
        outline: none;
    }

    .menu-toggle {
        width: 48px;
        height: 48px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        border-radius: 12px;
        cursor: pointer;
    }

    .menu-line {
        width: 24px;
        height: 2.5px;
        background: white;
        border-radius: 2px;
    }

    /* Categories Dropdown */
    #category-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 260px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 10px;
        margin-top: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 100;
        display: none;
    }

    .cat-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background: #157BFF;
        color: white;
        border-radius: 50px;
        margin-bottom: 8px;
        font-weight: 700;
        font-size: 14px;
        transition: 0.3s;
        text-decoration: none;
    }

    .cat-option:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(21, 123, 255, 0.3);
    }

    /* Horizontal Scroll Categories */
    .cats-scroll {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding: 10px 0;
        scrollbar-width: none;
        margin-bottom: 30px;
    }

    .cats-scroll::-webkit-scrollbar {
        display: none;
    }

    .cat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        min-width: 70px;
        text-decoration: none;
        color: inherit;
    }

    .cat-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .cat-circle.active {
        background: linear-gradient(135deg, #157BFF, #15488B);
        border-color: white;
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .cat-name {
        font-size: 11px;
        font-weight: 700;
        text-align: center;
        opacity: 0.9;
    }

    /* Materials Grid */
    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 15px;
    }

    .m-card {
        aspect-ratio: 1/1;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    }

    .m-media {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .m-label {
        position: absolute;
        bottom: 5px;
        width: 100%;
        text-align: center;
        font-size: 9px;
        font-weight: 700;
        background: rgba(0, 0, 0, 0.3);
        padding: 2px 0;
    }

    .empty-state {
        grid-column: span 3;
        text-align: center;
        padding: 40px 20px;
        opacity: 0.5;
        font-weight: 700;
    }
</style>

<div class="materials-wrap" data-aos="fade-up">
    <!-- Header -->
    <div class="m-header">
        <a href="index.php" class="m-header-icon">
            <i class="fa-solid fa-house"></i>
        </a>
        <div class="m-header-title">Материалы</div>
        <button id="materials-profile-btn" class="m-header-icon bg-transparent">
            <i class="fa-solid fa-user"></i>
        </button>
    </div>

    <!-- Search & Menu -->
    <div class="search-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass opacity-60"></i>
            <input type="text" id="search-input" class="search-input" placeholder="Поиск...">
        </div>
        <div class="menu-toggle" id="materials-popup-btn" onclick="toggleCategoryPopup()" style="cursor: pointer;">
            <div class="menu-line"></div>
            <div class="menu-line"></div>
            <div class="menu-line"></div>
        </div>
    </div>

    <!-- Category Popup Modal -->
    <div id="category-popup-overlay"></div>
    <div id="category-popup">
        <a href="materials.php" class="cat-popup-btn">
            <span>Визуальные Элементы</span>
            <img src="/static/img/popup/puzzle.png" alt="Puzzle"
                style="width: 32px; height: 32px; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
        </a>
        <a href="materials.php?cat=transitions" class="cat-popup-btn">
            <span>Переходы</span>
            <img src="/static/img/popup/scissors.png" alt="Scissors"
                style="width: 32px; height: 32px; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
        </a>
        <a href="materials.php?cat=sounds" class="cat-popup-btn">
            <span>Звуки</span>
            <img src="/static/img/popup/megaphone.png" alt="Megaphone"
                style="width: 32px; height: 32px; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
        </a>
        <a href="materials.php?cat=backgrounds" class="cat-popup-btn">
            <span>Фоны</span>
            <img src="/static/img/popup/gallery.png" alt="Gallery"
                style="width: 32px; height: 32px; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
        </a>
    </div>

    <!-- Hidden Dropdown -->
    <div id="category-dropdown">
        <a href="materials.php" class="cat-option">
            Визуальные Элементы <img src="/static/img/menu-visual.png" onerror="this.style.display='none'"
                style="width: 24px;">
        </a>
        <a href="materials.php?cat=transitions" class="cat-option">
            Переходы <img src="/static/img/menu-transitions.png" onerror="this.style.display='none'"
                style="width: 24px;">
        </a>
        <a href="materials.php?cat=sounds" class="cat-option">
            Звуки <img src="/static/img/menu-sounds.png" onerror="this.style.display='none'" style="width: 24px;">
        </a>
        <a href="materials.php?cat=backgrounds" class="cat-option">
            Фоны <img src="/static/img/menu-backgrounds.png" onerror="this.style.display='none'" style="width: 24px;">
        </a>
    </div>

    <!-- Horizontal Category Scroll (Sub-categories) -->
    <div class="cats-scroll">
        <?php foreach ($all_categories as $cat): ?>
            <?php if (!in_array($cat['slug'], ['transitions', 'backgrounds', 'sounds'])): ?>
                <a href="?cat=<?php echo urlencode($cat['slug']); ?>" class="cat-item">
                    <div
                        class="cat-circle <?php echo ($active_slug == $cat['slug'] || $active_name == $cat['name']) ? 'active' : ''; ?>">
                        <img src="/static/img/categories/<?php echo $cat['slug']; ?>.png"
                            onerror="this.src='/static/img/folder-icon.png'" alt="<?php echo $cat['name']; ?>"
                            style="width: 70%; height: 70%; object-fit: contain;">
                    </div>
                    <div class="cat-name"><?php echo $cat['name']; ?></div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Materials Grid -->
    <div class="materials-grid" id="materials-grid">
        <?php if (empty($materials)): ?>
            <div class="empty-state">
                <i class="fas fa-box-open text-4xl mb-4 block"></i>
                В этой категории пока нет материалов
            </div>
        <?php else: ?>
            <?php foreach ($materials as $m): ?>
                <a href="material_detail.php?id=<?php echo $m['id']; ?>" class="m-card group animate-fade-in"
                    onmouseenter="this.querySelector('video')?.play()" onmouseleave="this.querySelector('video')?.pause()">
                    <?php
                    $media_url = $m['image_url'];
                    $is_video = str_ends_with($media_url, '.mp4') || str_ends_with($media_url, '.webm') || str_ends_with($media_url, '.mov');
                    if ($is_video): ?>
                        <video class="m-media" src="<?php echo $media_url; ?>" muted loop playsinline preload="metadata"></video>
                    <?php else: ?>
                        <img class="m-media" src="<?php echo $media_url; ?>" alt="<?php echo $m['name']; ?>" loading="lazy">
                    <?php endif; ?>
                    <div class="m-label truncate px-1"><?php echo $m['name']; ?></div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    // Category Selection Popup Logic
    const popupModal = document.getElementById('category-popup');
    const popupOverlay = document.getElementById('category-popup-overlay');
    const popupBtn = document.getElementById('materials-popup-btn');

    function toggleCategoryPopup() {
        if (!popupModal) return;
        const isCurrentlyVisible = popupModal.style.display === 'block';
        if (isCurrentlyVisible) {
            popupModal.style.display = 'none';
            popupOverlay.style.display = 'none';
        } else {
            popupModal.style.display = 'block';
            popupOverlay.style.display = 'block';
        }
    }

    // Attach listeners
    if (popupBtn) {
        popupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleCategoryPopup();
        });
    }

    if (popupOverlay) {
        popupOverlay.addEventListener('click', toggleCategoryPopup);
    }

    // Close on outside click
    window.addEventListener('click', function(event) {
        if (popupModal && popupModal.style.display === 'block') {
            if (!event.target.closest('#category-popup') && !event.target.closest('#materials-popup-btn')) {
                toggleCategoryPopup();
            }
        }
    });

    // Close on Escape key
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popupModal && popupModal.style.display === 'block') {
            toggleCategoryPopup();
        }
    });

    // Simple search filter
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.m-card');
            cards.forEach(card => {
                const labelElement = card.querySelector('.m-label');
                if (labelElement) {
                    const label = labelElement.innerText.toLowerCase();
                    card.style.display = label.includes(term) ? 'flex' : 'none';
                }
            });
        });
    }

    function toggleCategoryDropdown() {
        const dropdown = document.getElementById('category-dropdown');
        if (dropdown) {
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }
    }
</script>

<?php include 'includes/footer.php'; ?>