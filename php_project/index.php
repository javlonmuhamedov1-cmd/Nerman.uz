<?php
$page_title = 'NERMAN.AI — AI Видеоредактор';
require_once 'includes/db.php';
require_once 'includes/auth.php';
$is_auth = is_authenticated();
include 'includes/header.php';
?>

<!-- Hero Section -->
<section id="home" class="relative overflow-hidden py-20 md:py-32">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="max-w-3xl" data-aos="fade-right">
                <h1 class="text-2xl md:text-6xl font-bold mb-6 text-[#157BFF] font-orbitron leading-tight">
                    Ваш AI-Видеоредактор для создания видео
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-8 leading-relaxed">
                    Монтаж без усилий с Nerman.ai — опиши идею, и ИИ создаст видео: Reels, Shorts, подкасты. Экономь
                    время, автоматизируй рутину.
                </p>
                <div>
                    <a href="<?php echo $is_auth ? '#' : 'register.php'; ?>"
                        id="<?php echo $is_auth ? 'home-create-btn' : ''; ?>"
                        class="inline-block px-8 py-4 text-lg font-bold text-white rounded-full transition-all hover:scale-105 shadow-lg hover:shadow-xl bg-gradient-to-r from-[#157BFF] to-[#15488B]">
                        Создать проект
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center items-end overflow-hidden" data-aos="zoom-in">
                <img src="/static/img/hero_phone_mrbeast_small.png" alt="App Dashboard Small"
                    class="h-[300px] md:h-[400px] w-auto max-w-[50%] md:max-w-full object-contain relative z-30 md:-mr-24 mb-4 drop-shadow-xl transform -rotate-3 hover:scale-105 transition-all duration-300">
                <img src="/static/img/hero_phone_mrbeast_new.png" alt="App Dashboard"
                    class="h-[400px] md:h-[500px] w-auto max-w-[80%] md:max-w-full object-contain relative z-20 drop-shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Company Logos Marquee -->
<section class="py-16 overflow-hidden border-b border-slate-100/10">
    <div class="relative w-full overflow-hidden group">
        <div class="flex w-max animate-marquee-robust group-hover:[animation-play-state:paused]">
            <div class="flex items-center gap-16 md:gap-32 pr-16 md:pr-32">
                <img src="/static/img/logos/tesla.png" alt="Tesla"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/apple.png" alt="Apple"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/google.png" alt="Google"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/microsoft.png" alt="Microsoft"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/spotify.png" alt="Spotify"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
            </div>
            <div class="flex items-center gap-16 md:gap-32 pr-16 md:pr-32">
                <img src="/static/img/logos/tesla.png" alt="Tesla"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/apple.png" alt="Apple"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/google.png" alt="Google"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/microsoft.png" alt="Microsoft"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/spotify.png" alt="Spotify"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
            </div>
            <div class="flex items-center gap-16 md:gap-32 pr-16 md:pr-32">
                <img src="/static/img/logos/tesla.png" alt="Tesla"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/apple.png" alt="Apple"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/google.png" alt="Google"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/microsoft.png" alt="Microsoft"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
                <img src="/static/img/logos/spotify.png" alt="Spotify"
                    class="h-8 md:h-12 w-auto object-contain opacity-70 hover:opacity-100 transition-all cursor-pointer">
            </div>
        </div>
    </div>
    <style>
        @keyframes marquee-robust {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-33.33%);
            }
        }

        .animate-marquee-robust {
            animation: marquee-robust 40s linear infinite;
        }
    </style>
</section>

<!-- Product Workflow Section -->
<section id="product" class="py-24 bg-transparent overflow-hidden">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl md:text-7xl font-extrabold text-center mb-24 text-[#157BFF]" data-aos="fade-down">
            Как это работает
        </h2>

        <div class="flex flex-col md:flex-row items-center justify-between gap-16 mb-32" data-aos="fade-up">
            <div class="md:w-1/2 space-y-12">
                <div class="bg-blue-50/50 p-8 rounded-[30px] border-2 border-[#157BFF]/10 shadow-sm">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4 flex items-center">
                        <span
                            class="w-12 h-12 bg-[#157BFF] text-white rounded-full flex items-center justify-center mr-4 shrink-0">1</span>
                        Загрузи видео
                    </h3>
                    <p class="text-xl text-slate-600 leading-relaxed">Загрузи своё видео или выбери из библиотеки
                        материалов платформы.</p>
                </div>
                <div class="bg-blue-50/50 p-8 rounded-[30px] border-2 border-[#157BFF]/10 shadow-sm">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4 flex items-center">
                        <span
                            class="w-12 h-12 bg-[#157BFF] text-white rounded-full flex items-center justify-center mr-4 shrink-0">2</span>
                        ИИ обрабатывает
                    </h3>
                    <p class="text-xl text-slate-600 leading-relaxed">Наш ИИ автоматически подбирает переходы, эффекты и
                        музыку.</p>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-[#157BFF] to-blue-400 rounded-[50px] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity">
                    </div>
                    <img src="/static/img/product/robot_editing_1.jpg" alt="AI Editing"
                        class="relative z-10 w-full max-w-[500px] h-auto rounded-[40px] shadow-2xl">
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row-reverse items-center justify-between gap-16 mb-32" data-aos="fade-up">
            <div class="md:w-1/2 space-y-12">
                <div class="bg-blue-50/50 p-8 rounded-[30px] border-2 border-[#157BFF]/10 shadow-sm">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4 flex items-center">
                        <span
                            class="w-12 h-12 bg-[#157BFF] text-white rounded-full flex items-center justify-center mr-4 shrink-0">3</span>
                        Выбери стиль
                    </h3>
                    <p class="text-xl text-slate-600 leading-relaxed">Выбирай из сотен готовых шаблонов для любого
                        контента.</p>
                </div>
                <div class="bg-blue-50/50 p-8 rounded-[30px] border-2 border-[#157BFF]/10 shadow-sm">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4 flex items-center">
                        <span
                            class="w-12 h-12 bg-[#157BFF] text-white rounded-full flex items-center justify-center mr-4 shrink-0">4</span>
                        Скачай результат
                    </h3>
                    <p class="text-xl text-slate-600 leading-relaxed">Готовое видео в HD качестве за считанные минуты.
                    </p>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-400 to-[#157BFF] rounded-[50px] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity">
                    </div>
                    <img src="/static/img/product/robot_editing_2.jpg" alt="AI Styling"
                        class="relative z-10 w-full max-w-[500px] h-auto rounded-[40px] shadow-2xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Story Sections -->
<section id="our-story" class="py-24 bg-transparent overflow-hidden">
    <div class="container mx-auto px-4">

        <!-- Section 1: NERMAN.AI Overview -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-12 mb-32" data-aos="fade-up">
            <div
                class="md:w-[500px] bg-white/60 backdrop-blur-xl border border-white/60 rounded-[35px] p-8 md:p-12 shadow-2xl relative order-2 md:order-1">
                <h2 class="text-4xl font-black text-[#157BFF] mb-6 font-orbitron">NERMAN.AI</h2>
                <p class="text-lg text-slate-600 font-medium leading-relaxed">
                    Это не просто стартап, это команда инноваторов которые продолжают дело наших великих Джадидов, строя
                    цифровое будущее Узбекистана.
                </p>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-[#157BFF]/10 rounded-full blur-3xl"></div>
            </div>
            <div class="md:w-1/3 flex justify-center order-1 md:order-2" data-aos="fade-left">
                <img src="/static/img/about/businessman1.png" alt="NERMAN AI Story"
                    class="w-64 h-auto object-contain drop-shadow-2xl">
            </div>
        </div>

        <!-- Section 2: Mission -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-12 mb-32" data-aos="fade-up">
            <div class="md:w-1/3 flex justify-center" data-aos="fade-right">
                <img src="/static/img/about/businessman2.png" alt="Our Mission"
                    class="w-64 h-auto object-contain drop-shadow-2xl">
            </div>
            <div
                class="md:w-[500px] bg-white/60 backdrop-blur-xl border border-white/60 rounded-[35px] p-8 md:p-12 shadow-2xl relative">
                <h2 class="text-3xl font-black text-[#157BFF] mb-6 font-orbitron">Наша миссия:</h2>
                <p class="text-lg text-slate-600 font-medium leading-relaxed">
                    Убрать барьеры в видеомонтаже, чтобы люди могли меньше работать и больше творить.
                </p>
                <div class="absolute -top-6 -left-6 w-24 h-24 bg-blue-400/10 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Section 3: Join Us -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-12" data-aos="fade-up">
            <div
                class="md:w-[500px] bg-white/60 backdrop-blur-xl border border-white/60 rounded-[35px] p-8 md:p-12 shadow-2xl relative order-2 md:order-1">
                <p class="text-lg text-slate-600 font-medium leading-relaxed">
                    Присоединяйтесь к нам и станьте частью будущего которое создаётся сегодня.
                </p>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-[#157BFF]/10 rounded-full blur-3xl"></div>
            </div>
            <div class="md:w-1/3 flex justify-center order-1 md:order-2" data-aos="fade-left">
                <img src="/static/img/about/businessman3.png" alt="Join Nerman AI"
                    class="w-64 h-auto object-contain drop-shadow-2xl">
            </div>
        </div>

    </div>
</section>

<!-- Team Section -->
<section id="team" class="py-24 bg-transparent" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#157BFF]" data-aos="fade-down" data-aos-delay="100">
            Наша Команда
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-[1200px] mx-auto">
            <div class="bg-white border-2 border-blue-200 rounded-[24px] p-8 shadow-sm hover:shadow-xl transition-all duration-300 text-center flex flex-col items-center"
                data-aos="fade-up" data-aos-delay="200">
                <div class="w-32 h-32 rounded-full border-4 border-[#157BFF] overflow-hidden mb-6">
                    <img src="/static/img/team/meyrman.jpg" alt="Kucherbaev Meyrman" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Kucherbaev Meyrman</h3>
                <p class="text-[#157BFF] font-medium mb-4">CEO & Founder</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Видеограф и специалист по ИИ-технологиям.
                    Основатель NERMAN.AI.</p>
                <div class="flex gap-4 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-linkedin-in text-lg"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-twitter text-lg"></i></a>
                </div>
            </div>

            <div class="bg-white border-2 border-blue-200 rounded-[24px] p-8 shadow-sm hover:shadow-xl transition-all duration-300 text-center flex flex-col items-center"
                data-aos="fade-up" data-aos-delay="300">
                <div class="w-32 h-32 rounded-full border-4 border-[#157BFF] overflow-hidden mb-6">
                    <img src="/static/img/team/alibek_final.png" alt="Abdusamadov Alibek"
                        class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Abdusamadov Alibek</h3>
                <p class="text-[#157BFF] font-medium mb-4">UI/UX Designer</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Специалист по дизайну пользовательского опыта.
                </p>
                <div class="flex gap-4 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-linkedin-in text-lg"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-twitter text-lg"></i></a>
                </div>
            </div>

            <div class="bg-white border-2 border-blue-200 rounded-[24px] p-8 shadow-sm hover:shadow-xl transition-all duration-300 text-center flex flex-col items-center"
                data-aos="fade-up" data-aos-delay="400">
                <div class="w-32 h-32 rounded-full border-4 border-[#157BFF] overflow-hidden mb-6">
                    <img src="/static/img/team/javohir_final.png" alt="Javohir" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Javohir Qobiljonov</h3>
                <p class="text-[#157BFF] font-medium mb-4">CTO</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Технический директор и backend-специалист.</p>
                <div class="flex gap-4 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-linkedin-in text-lg"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors"><i
                            class="fa-brands fa-github text-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section (New) -->
<section class="py-24 bg-gradient-to-b from-white to-blue-50">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-3xl md:text-5xl font-extrabold text-center mb-16 text-slate-800" data-aos="fade-down">
            Почему выбирают <span class="text-[#157BFF] font-orbitron">NERMAN.AI</span>
        </h2>

        <div class="bg-white/40 backdrop-blur-xl border border-white/60 rounded-[40px] shadow-2xl p-8 md:p-16"
            data-aos="fade-up">

            <!-- What bothers you -->
            <div class="mb-16">
                <h3 class="text-2xl md:text-3xl font-bold text-[#157BFF] mb-10 border-b-2 border-blue-100 pb-4">Что вас
                    Мучает</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="flex flex-col gap-4">
                        <div
                            class="w-14 h-14 bg-white rounded-2xl shadow-md flex items-center justify-center border border-blue-50">
                            <i class="fas fa-hourglass-half text-[#157BFF] text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Долгий процесс</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">В среднем видеомонтажеры тратят 2 часа на
                                создание одного релиза.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div
                            class="w-14 h-14 bg-white rounded-2xl shadow-md flex items-center justify-center border border-blue-50">
                            <i class="fas fa-layer-group text-[#157BFF] text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Многозадачность</h4>
                            <ul class="text-[11px] text-slate-500 space-y-1 font-medium list-disc list-inside">
                                <li>Обрезка моментов</li>
                                <li>Зум</li>
                                <li>Переходы</li>
                                <li>Материалы</li>
                                <li>Стоковые ролики</li>
                                <li>Субтитры</li>
                                <li>Эффекты</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div
                            class="w-14 h-14 bg-white rounded-2xl shadow-md flex items-center justify-center border border-blue-50">
                            <i class="fas fa-user-gear text-[#157BFF] text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Человеческий фактор</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">Занятость, неуспевание, границы работы,
                                нехватка энергии, внешние факторы.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-px bg-gradient-to-r from-transparent via-blue-200 to-transparent mb-16"></div>

            <!-- Our Solution -->
            <div>
                <h3 class="text-2xl md:text-3xl font-bold text-[#157BFF] mb-10 border-b-2 border-blue-100 pb-4">Наше
                    Решение</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="flex flex-col gap-4">
                        <div class="w-14 h-14 bg-[#157BFF] rounded-2xl shadow-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-white text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Быстрый процесс</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">Чтобы получить результат ролика достаточно
                                одной минуты.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="w-14 h-14 bg-[#157BFF] rounded-2xl shadow-lg flex items-center justify-center">
                            <i class="fas fa-robot text-white text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Автоматизация</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">NERMAN AI объединяет в себе все функции
                                монтажёра, чем другие ИИ-видеоредакторы.</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="w-14 h-14 bg-[#157BFF] rounded-2xl shadow-lg flex items-center justify-center">
                            <i class="fas fa-gem text-white text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-slate-800">Совершенство</h4>
                            <ul class="text-[11px] text-slate-500 space-y-1 font-medium list-none">
                                <li>✅ Без оправданий</li>
                                <li>✅ Без срывов</li>
                                <li>✅ Только концентрация</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>