<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$success = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic form handling mock
    $success = "Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.";
}

$page_title = 'Контакты — NERMAN.AI';
include 'includes/header.php';
?>

<style>
    .contact-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border-radius: 40px;
        border: 2px solid rgba(21, 123, 255, 0.08);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
    }

    .contact-input {
        width: 100%;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 18px;
        padding: 18px 22px;
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        outline: none;
        transition: border-color 0.3s, box-shadow 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .contact-input:focus {
        border-color: #157BFF;
        box-shadow: 0 0 0 4px rgba(21, 123, 255, 0.12);
        background: white;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 22px 28px;
        background: white;
        border-radius: 24px;
        border: 2px solid rgba(21, 123, 255, 0.06);
        transition: all 0.3s;
        text-decoration: none;
    }

    .contact-info-item:hover {
        border-color: #157BFF;
        box-shadow: 0 8px 24px rgba(21, 123, 255, 0.1);
        transform: translateY(-2px);
    }

    .contact-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, #157BFF, #15488B);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        flex-shrink: 0;
    }
</style>

<div class="container mx-auto px-4 py-28 max-w-6xl">
    <div class="text-center mb-20" data-aos="fade-down">
        <h1 class="text-5xl md:text-6xl font-bold font-orbitron">
            <span class="gradient-text">Контакты</span>
        </h1>
        <p class="text-xl text-slate-500 mt-4 max-w-xl mx-auto">
            У вас есть вопросы? Напишите нам — мы ответим в течение 24 часов.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-start">
        <!-- Contact Info -->
        <div class="space-y-6" data-aos="fade-right">
            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase mb-1">Почта</p>
                    <a href="mailto:1nerman.ai1@gmail.com"
                        class="text-lg font-bold text-slate-800 hover:text-[#157BFF] transition-colors text-decoration-none">1nerman.ai1@gmail.com</a>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase mb-1">Телефон</p>
                    <a href="tel:+998938023376"
                        class="text-lg font-bold text-slate-800 hover:text-[#157BFF] transition-colors text-decoration-none">+998
                        93
                        802-33-76</a>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase mb-1">Адрес</p>
                    <p class="text-lg font-bold text-slate-800">Ташкент, Узбекистан</p>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="fab fa-telegram"></i></div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase mb-1">Telegram</p>
                    <a href="https://t.me/kucherbaev_17" target="_blank"
                        class="text-lg font-bold text-slate-800 hover:text-[#157BFF] transition-colors text-decoration-none">@kucherbaev_17</a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-card p-10" data-aos="fade-left">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Написать сообщение</h2>
            <?php if ($success): ?>
                <div class="mb-6 p-4 bg-green-50 border-2 border-green-200 text-green-700 rounded-2xl font-bold">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="contact.php" class="space-y-5">
                <input type="text" name="name" placeholder="Ваше имя" required class="contact-input">
                <input type="email" name="email" placeholder="Ваш Email" required class="contact-input">
                <input type="text" name="subject" placeholder="Тема" class="contact-input">
                <textarea name="message" placeholder="Ваше сообщение" rows="5" required class="contact-input"
                    style="resize:vertical;"></textarea>
                <button type="submit"
                    class="w-full py-5 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white rounded-2xl font-bold text-lg shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-95 transition-all">
                    Отправить сообщение <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>