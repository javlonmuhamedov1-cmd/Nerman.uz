<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$page_title = 'Политика конфиденциальности — NERMAN.AI';
include 'includes/header.php';
?>

<div class="container mx-auto px-4 py-28 max-w-4xl">
    <div class="text-center mb-16" data-aos="fade-down">
        <h1 class="text-5xl font-bold font-orbitron">
            <span class="gradient-text">Политика конфиденциальности</span>
        </h1>
        <p class="text-slate-400 mt-4">Последнее обновление: 29 мая 2026 г.</p>
    </div>

    <div class="space-y-6" data-aos="fade-up">
        <div class="bg-white/70 backdrop-blur-md rounded-[30px] p-10 border-2 border-slate-50 shadow-sm">
            <h2 class="text-2xl font-bold text-[#157BFF] mb-4 font-orbitron">
                О конфиденциальности
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Ваша конфиденциальность важна для нас. Политика NERMAN.AI заключается в уважении вашей
                конфиденциальности в отношении любой информации, которую мы можем собирать у вас на нашем веб-сайте.
            </p>
        </div>

        <div class="bg-white/70 backdrop-blur-md rounded-[30px] p-10 border-2 border-slate-50 shadow-sm">
            <h2 class="text-2xl font-bold text-[#157BFF] mb-4 font-orbitron">
                1. Информация, которую мы собираем
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Мы запрашиваем личную информацию только тогда, когда она нам действительно нужна для предоставления вам
                услуги. Мы собираем ее честными и законными способами, с вашего ведома и согласия.
            </p>
        </div>

        <div class="bg-white/70 backdrop-blur-md rounded-[30px] p-10 border-2 border-slate-50 shadow-sm">
            <h2 class="text-2xl font-bold text-[#157BFF] mb-4 font-orbitron">
                2. Хранение данных
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Мы храним собранную информацию только до тех пор, пока это необходимо для предоставления вам запрошенной
                услуги. Хранимые данные защищены средствами коммерчески приемлемого уровня для предотвращения потери и
                кражи.
            </p>
        </div>

        <div class="bg-white/70 backdrop-blur-md rounded-[30px] p-10 border-2 border-slate-50 shadow-sm">
            <h2 class="text-2xl font-bold text-[#157BFF] mb-4 font-orbitron">
                3. Файлы cookies
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Мы используем файлы cookie для сбора информации о вашей активности на нашем сайте, чтобы улучшить ваш
                опыт. Вы можете настроить свой браузер на отказ от всех файлов cookie.
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>