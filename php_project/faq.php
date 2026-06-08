<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

// Fetch FAQs from DB
$stmt = $pdo->query("SELECT * FROM faqs ORDER BY id ASC");
$faqs = $stmt->fetchAll();

$page_title = 'FAQ — NERMAN.AI';
include 'includes/header.php';
?>

<div class="container mx-auto px-4 py-24 max-w-4xl">
    <h1 class="text-5xl font-bold mb-10 font-orbitron text-center pt-10" data-aos="fade-down">
        <span class="gradient-text">Вопросы и Ответы</span>
    </h1>

    <div class="space-y-6">
        <?php if (!empty($faqs)): ?>
            <?php foreach ($faqs as $item): ?>
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-[#157BFF] transition-all"
                    data-aos="fade-up">
                    <h3 class="text-xl font-bold mb-4 text-slate-900">
                        <?php echo $item['question']; ?>
                    </h3>
                    <p class="text-slate-600">
                        <?php echo $item['answer']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Hardcoded Fallbacks for exact parity -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 mb-6" data-aos="fade-up">
                <h3 class="text-xl font-bold mb-4 text-slate-900">Что такое NERMAN.AI?</h3>
                <p class="text-slate-600">NERMAN.AI — это профессиональная платформа для видеомейкеров, предоставляющая
                    инструменты на базе ИИ для создания качественного контента.</p>
            </div>
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 mb-6" data-aos="fade-up">
                <h3 class="text-xl font-bold mb-4 text-slate-900">Как скачать материалы?</h3>
                <p class="text-slate-600">Вы можете скачать материалы после регистрации и выбора подходящего тарифного плана
                    в разделе "Материалы".</p>
            </div>
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 mb-6" data-aos="fade-up">
                <h3 class="text-xl font-bold mb-4 text-slate-900">Как работает подписка?</h3>
                <p class="text-slate-600">Подписка дает вам неограниченный доступ ко всем материалам платформы на
                    определенный период времени.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>