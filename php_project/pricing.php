<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$page_title = 'Цены — NERMAN.AI';
include 'includes/header.php';
?>

<style>
    :root {
        --nerman-blue: #0A5BD1;
        --card-bg: rgba(255, 255, 255, 0.05);
        --card-border: rgba(255, 255, 255, 0.4);
    }

    .pricing-modal {
        background: var(--nerman-blue);
        border-radius: 40px;
        padding: 40px;
        max-width: 500px;
        margin: 40px auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .pricing-title {
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        color: white;
        margin-bottom: 40px;
        text-transform: none;
    }

    .pricing-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .pricing-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 24px;
        padding: 24px;
        position: relative;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .plan-name {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .price-display {
        display: flex;
        align-items: baseline;
        gap: 6px;
        color: white;
    }

    .price-value {
        font-size: 32px;
        font-weight: 700;
    }

    .price-currency {
        font-size: 16px;
        opacity: 0.9;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
    }

    .features-list li {
        color: white;
        font-size: 13px;
        margin-bottom: 10px;
        padding-left: 15px;
        position: relative;
        opacity: 0.9;
    }

    .features-list li:before {
        content: "";
        position: absolute;
        left: 0;
        top: 8px;
        width: 4px;
        height: 4px;
        background: white;
        border-radius: 50%;
    }

    .buy-button {
        width: 100%;
        background: linear-gradient(180deg, #2A7AF0 0%, #157BFF 100%);
        color: white;
        border: none;
        border-radius: 24px;
        padding: 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: block;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
</style>

<div class="min-h-screen py-12" style="background: transparent;">
    <div class="pricing-modal" data-aos="zoom-in">
        <h1 class="pricing-title">Цены Подписок</h1>

        <div class="pricing-grid">
            <!-- Freemium -->
            <div class="pricing-card">
                <div class="card-header">
                    <div class="plan-name">Freemium</div>
                    <div class="price-display">
                        <span class="price-value">0</span>
                        <span class="price-currency">сум</span>
                    </div>
                </div>
                <ul class="features-list">
                    <li>Скачивание пробного материала</li>
                </ul>
                <a href="materials.php" class="buy-button">Попробовать Бесплатно</a>
            </div>

            <!-- Medium -->
            <div class="pricing-card">
                <div class="card-header">
                    <div class="plan-name">Medium</div>
                    <div class="price-display">
                        <span class="price-value">99.000</span>
                        <span class="price-currency">сум</span>
                    </div>
                </div>
                <ul class="features-list">
                    <li>Полный доступ ко всем материалам</li>
                    <li>Регулярные обновления</li>
                </ul>
                <a href="https://t.me/kucherbaev_17" class="buy-button">Месячный план</a>
            </div>

            <!-- Single -->
            <div class="pricing-card">
                <div class="card-header">
                    <div class="plan-name">Single</div>
                    <div class="price-display">
                        <span class="price-value">7.000</span>
                        <span class="price-currency">сум</span>
                    </div>
                </div>
                <ul class="features-list">
                    <li>Разовая покупка материала</li>
                    <li>Разовая покупка пака материалов</li>
                </ul>
                <a href="https://t.me/kucherbaev_17" class="buy-button">Разовый план</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>