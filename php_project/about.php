<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$page_title = 'О нас — NERMAN.AI';
include 'includes/header.php';
?>

<!-- About Hero -->
<div class="container mx-auto px-4 py-24 max-w-6xl text-center">
    <h1 class="text-6xl font-bold mb-8 font-orbitron pt-10" data-aos="fade-down">
        О нас <span class="gradient-text">NERMAN.AI</span>
    </h1>
    <p class="text-2xl text-slate-600 max-w-4xl mx-auto leading-relaxed mb-12" data-aos="fade-up">
        Мы — команда профессионалов, стремящихся сделать монтаж видео доступным для каждого с помощью искусственного
        интеллекта.
    </p>

    <!-- Mission & Vision Cards -->
    <div class="grid md:grid-cols-2 gap-12 text-left mb-24">
        <div class="bg-white p-12 rounded-[50px] shadow-xl border-2 border-blue-50" data-aos="fade-right">
            <h2 class="text-3xl font-bold text-[#157BFF] mb-6 font-orbitron">Наша Миссия</h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Упростить процесс создания видеоконтента, предоставляя инновационные ИИ-инструменты, которые экономят
                время и ресурсы.
            </p>
        </div>
        <div class="bg-white p-12 rounded-[50px] shadow-xl border-2 border-indigo-50" data-aos="fade-left">
            <h2 class="text-3xl font-bold text-[#157BFF] mb-6 font-orbitron">Наше Видение</h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Стать ведущей мировой платформой для автоматизированного видеопроизводства, вдохновляя креаторов на
                новые достижения.
            </p>
        </div>
    </div>
</div>

<!-- Team Section -->
<section id="team" class="py-24 bg-slate-50">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-center mb-20 text-[#157BFF] font-orbitron" data-aos="fade-down">
            Наша Команда
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-[1200px] mx-auto">
            <div class="bg-white rounded-[40px] border-2 border-[#157BFF]/10 p-10 shadow-lg text-center flex flex-col items-center"
                data-aos="fade-up">
                <div class="w-40 h-40 rounded-full border-4 border-[#157BFF] overflow-hidden mb-8 shadow-xl">
                    <img src="/static/img/team/meyrman.jpg" alt="Meyrman" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Мейрман</h3>
                <p class="text-[#157BFF] font-bold mb-6">CEO & Founder</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-8">Визионер и основатель проекта NERMAN.AI.</p>
                <div class="flex gap-6 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <div class="bg-white rounded-[40px] border-2 border-[#157BFF]/10 p-10 shadow-lg text-center flex flex-col items-center"
                data-aos="fade-up" data-aos-delay="100">
                <div class="w-40 h-40 rounded-full border-4 border-[#157BFF] overflow-hidden mb-8 shadow-xl">
                    <img src="/static/img/team/alibek_new.png" alt="Alibek" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Алибек</h3>
                <p class="text-[#157BFF] font-bold mb-6">UI/UX Designer</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-8">Создает интуитивно понятные и эстетичные
                    интерфейсы.</p>
                <div class="flex gap-6 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <div class="bg-white rounded-[40px] border-2 border-[#157BFF]/10 p-10 shadow-lg text-center flex flex-col items-center"
                data-aos="fade-up" data-aos-delay="200">
                <div class="w-40 h-40 rounded-full border-4 border-[#157BFF] overflow-hidden mb-8 shadow-xl">
                    <img src="/static/img/team/javohir_new.png" alt="Javohir" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Жавохир</h3>
                <p class="text-[#157BFF] font-bold mb-6">CTO</p>
                <p class="text-slate-600 text-sm leading-relaxed mb-8">Отвечает за архитектуру и техническое развитие
                    платформы.</p>
                <div class="flex gap-6 justify-center text-slate-400">
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="hover:text-[#157BFF] transition-colors text-xl"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>