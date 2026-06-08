<?php
require_once 'includes/db.php';
$current_page = basename($_SERVER['PHP_SELF']);
$is_auth = is_authenticated();
$current_user = $is_auth ? get_user_data($_SESSION['user_id']) : null;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NERMAN.AI - Professional Visual Elements</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        orbitron: ['Orbitron', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        nermanBlue: '#0055D4',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Orbitron:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        .gradient-text {
            background: linear-gradient(90deg, #157BFF 0%, #15488B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
            opacity: 0;
            pointer-events: none;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 900;
        }

        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        #global-sidebar {
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1000;
            background: #156BF0 !important;
            /* Deep Blue from Reference */
            width: 280px;
            border-radius: 0 40px 40px 0;
        }

        #global-sidebar.closed {
            transform: translateX(-100%);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Sidebar Item - Vertical Pill Style */
        .sidebar-item-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 10px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.12);
            /* Brighter glass effect */
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 12px;
            text-decoration: none !important;
        }

        .sidebar-item-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .sidebar-item-btn img {
            width: 75px;
            height: 75px;
            object-fit: contain;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.25));
        }

        .sidebar-item-btn span {
            font-weight: 700;
            font-size: 14px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Dual-line Info Item Style */
        .info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 15px;
        }

        .info-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            opacity: 0.9;
        }

        .info-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.1;
        }

        .info-label {
            font-size: 9px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 1px;
            text-transform: capitalize;
        }

        /* Glassmorphism Classes */
        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
        }
    </style>
</head>

<body
    class="<?php echo $body_class ?? 'bg-white text-slate-900'; ?> min-h-screen overflow-x-hidden w-full relative font-inter">

    <?php if ($is_auth): ?>
        <!-- Global Sidebar Overlay -->
        <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0"></div>

        <!-- Global Sidebar Drawer -->
        <aside id="global-sidebar"
            class="fixed left-0 top-0 h-full text-white shadow-2xl closed flex flex-col no-scrollbar overflow-y-auto pb-10">
            <button id="close-sidebar" class="absolute top-4 right-4 text-white hover:text-blue-200 z-10">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="flex flex-col items-center pt-10 px-6">
                <!-- User Avatar -->
                <div class="mb-3 relative">
                    <div class="w-24 h-24 rounded-full border-[3px] border-white/40 p-1 relative shadow-xl">
                        <?php if ($current_user && $current_user['avatar']): ?>
                            <img src="<?php echo $current_user['avatar']; ?>" class="w-full h-full rounded-full object-cover">
                        <?php else: ?>
                            <div
                                class="w-full h-full bg-slate-400/30 backdrop-blur-md rounded-full flex items-center justify-center text-4xl font-black font-orbitron">
                                <?php echo $current_user ? strtoupper(substr($current_user['username'], 0, 1)) : 'U'; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Small Plus Icon -->
                        <div
                            class="absolute bottom-1 right-1 w-6 h-6 bg-white/30 backdrop-blur-md border border-white/40 rounded-full flex items-center justify-center text-[10px]">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="text-xl font-extrabold mb-8 font-inter tracking-tight">
                    <?php echo $current_user['nickname'] ?? $current_user['username'] ?? 'User'; ?>
                </div>

                <!-- Info Card -->
                <div class="w-full bg-white/10 backdrop-blur-md rounded-[30px] p-6 mb-8 border border-white/20">
                    <div class="flex justify-between items-center mb-6">
                        <span class="flex items-center gap-3 text-xs font-black tracking-widest uppercase">
                            <i class="fas fa-file-lines text-sm"></i> Информация
                        </span>
                        <i class="fas fa-pencil-alt text-xs opacity-60"></i>
                    </div>

                    <div class="space-y-5">
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-phone-flip"></i></div>
                            <div class="info-content">
                                <span
                                    class="info-value"><?php echo $current_user['phone'] ?? '+998 ( - ) --- -- --'; ?></span>
                                <span class="info-label">Телефон</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="info-content">
                                <span
                                    class="info-value truncate w-44"><?php echo $current_user['email'] ?? 'example@mail.com'; ?></span>
                                <span class="info-label">Почта</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-user-tag"></i></div>
                            <div class="info-content">
                                <span class="info-value">@<?php echo $current_user['username']; ?></span>
                                <span class="info-label">Имя пользователя</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-id-badge"></i></div>
                            <div class="info-content">
                                <span
                                    class="info-value"><?php echo ($current_user['subscription_type'] ?? 'None') == 'Pro' ? 'Premium' : 'Free'; ?></span>
                                <span class="info-label">Тип подписки</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="w-full space-y-4 px-2">
                    <a href="#" class="sidebar-item-btn">
                        <img src="/static/img/sidebar/headphones.png?v=1.1" alt="Music"
                            onerror="this.src='/static/img/sidebar/headphones.png?v=1.1'">
                        <span>Найти песню</span>
                    </a>
                    <a href="#" class="sidebar-item-btn">
                        <img src="/static/img/sidebar/speech.png?v=1.1" alt="Subtitles"
                            onerror="this.src='/static/img/sidebar/speech.png?v=1.1'">
                        <span>Субтитры</span>
                    </a>
                    <a href="materials.php" class="sidebar-item-btn">
                        <img src="/static/img/sidebar/folder.png?v=1.1" alt="Materials"
                            onerror="this.src='/static/img/sidebar/folder.png?v=1.1'">
                        <span>Материалы</span>
                    </a>
                    <a href="#" class="sidebar-item-btn">
                        <img src="/static/img/sidebar/palette.png?v=1.1" alt="Creative"
                            onerror="this.src='/static/img/sidebar/palette.png?v=1.1'">
                        <span>Креативность</span>
                    </a>
                </div>

                <a href="logout.php"
                    class="mt-10 text-white/50 hover:text-white text-xs font-bold transition-all text-decoration-none">Выйти
                    из аккаунта</a>
            </div>
        </aside>
    <?php endif; ?>

    <?php if (!isset($hide_header) || !$hide_header): ?>
        <!-- Header -->
        <header class="sticky top-0 z-50 pt-[25px] pb-6 bg-transparent">
            <nav class="container mx-auto px-4">
                <div class="flex items-center justify-between gap-4">
                    <div
                        class="bg-white/80 backdrop-blur-md rounded-[15px] px-8 py-2 flex items-center shadow-lg h-[80px] flex-grow justify-between border border-white/20">
                        <!-- Logo -->
                        <a href="index.php"
                            class="text-2xl font-bold gradient-text font-orbitron mr-8 text-decoration-none">NERMAN.AI</a>

                        <div class="hidden md:flex items-center space-x-1">
                            <a href="index.php"
                                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-900 hover:text-[#157BFF] whitespace-nowrap text-decoration-none">Главная</a>
                            <a href="materials.php"
                                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-900 hover:text-[#157BFF] whitespace-nowrap text-decoration-none">Материалы</a>
                            <a href="pricing.php"
                                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-900 hover:text-[#157BFF] whitespace-nowrap text-decoration-none">Цены</a>
                            <a href="#"
                                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-900 hover:text-[#157BFF] whitespace-nowrap text-decoration-none">О
                                нас</a>
                            <a href="#"
                                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-900 hover:text-[#157BFF] whitespace-nowrap text-decoration-none">Контакты</a>
                        </div>

                        <!-- Auth Buttons -->
                        <div class="hidden md:flex items-center space-x-4">
                            <?php if ($is_auth): ?>
                                <button id="header-dashboard-btn"
                                    class="px-8 py-3 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white rounded-full font-bold hover:shadow-lg transition-all text-sm shadow-md h-[43px] flex items-center">Dashboard</button>
                            <?php else: ?>
                                <div
                                    class="flex items-center justify-between bg-slate-100 rounded-[15px] p-2 w-[280px] h-[60px] shadow-sm">
                                    <a href="login.php"
                                        class="flex-1 flex items-center justify-center h-full rounded-[12px] text-[#157BFF] font-bold text-lg hover:text-[#15488B] transition-all text-decoration-none">Войти</a>
                                    <a href="register.php"
                                        class="flex-1 flex items-center justify-center h-full bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white rounded-[12px] font-bold text-base hover:shadow-lg transition-all text-decoration-none">Создать</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Mobile Menu Button -->
                        <div class="flex md:hidden items-center space-x-3">
                            <button id="mobile-menu-btn"
                                class="text-2xl text-slate-800 bg-slate-200 w-12 h-10 flex items-center justify-center rounded-xl">☰</button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu"
                    class="hidden mt-3 bg-white/95 backdrop-blur-lg rounded-2xl p-4 shadow-xl border border-slate-100">
                    <a href="index.php"
                        class="block py-3 px-4 text-slate-900 font-bold rounded-xl hover:bg-slate-50 transition-all text-decoration-none">Главная</a>
                    <a href="materials.php"
                        class="block py-3 px-4 text-slate-900 font-bold rounded-xl hover:bg-slate-50 transition-all text-decoration-none">Материалы</a>
                    <div class="border-t border-slate-100 mt-3 pt-3">
                        <?php if ($is_auth): ?>
                            <button id="mobile-dashboard-btn"
                                class="block w-full py-3 px-4 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white font-bold rounded-xl text-center">Dashboard</button>
                        <?php else: ?>
                            <a href="login.php"
                                class="block py-3 px-4 text-[#157BFF] font-bold rounded-xl text-center hover:bg-blue-50 transition-all text-decoration-none">Войти</a>
                            <a href="register.php"
                                class="block py-3 px-4 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white font-bold rounded-xl text-center mt-2 text-decoration-none">Создать</a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>

    <?php endif; ?>
    
    <script>
        // Sidebar Toggle Logic
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('global-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const dashboardBtn = document.getElementById('header-dashboard-btn');
            const mobileDashboardBtn = document.getElementById('mobile-dashboard-btn');
            const homeCreateBtn = document.getElementById('home-create-btn');
            const materialsMenuBtn = document.getElementById('materials-menu-btn');
            const materialsProfileBtn = document.getElementById('materials-profile-btn');
            const closeBtn = document.getElementById('close-sidebar');

            function toggleSidebar() {
                if (!sidebar) return;
                sidebar.classList.toggle('closed');
                if (overlay) overlay.classList.toggle('active');
            }

            if (dashboardBtn) dashboardBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebar(); });
            if (mobileDashboardBtn) mobileDashboardBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebar(); });
            if (homeCreateBtn) homeCreateBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebar(); });
            if (materialsMenuBtn) materialsMenuBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebar(); });
            if (materialsProfileBtn) materialsProfileBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebar(); });
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);

            // AOS Init
            AOS.init({
                duration: 800,
                once: true,
                offset: 50
            });
        });

        // Mobile Menu Logic
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
