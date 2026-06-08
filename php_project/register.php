<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

if (is_authenticated()) {
    header("Location: index.php");
    exit;
}

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $otp = $_POST['otp'] ?? '';

    if ($otp !== '555555') {
        $error = "Неверный код верификации (используйте 555555)";
    } else {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Пользователь с таким email уже существует";
        } else {
            // Create user
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_pass]);
            $user_id = $pdo->lastInsertId();

            // Create profile
            $stmt = $pdo->prepare("INSERT INTO profiles (user_id, subscription_type) VALUES (?, 'None')");
            $stmt->execute([$user_id]);

            // Auto-login and redirect
            login_user($user_id, 'None');
            header("Location: index.php");
            exit;
        }
    }
}

$page_title = 'Регистрация — NERMAN.AI';
$hide_header = false;
$hide_footer = true;
include 'includes/header.php';
?>

<style>
    .glass-effect-reg {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .bg-blob-1 {
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
    }

    .bg-blob-2 {
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    }

    .input-focus:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
</style>

<div class="min-h-[85vh] relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blob-1 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] bg-blob-2 pointer-events-none"></div>

    <div class="w-full max-w-[480px] z-10">
        <div class="text-center mb-8" data-aos="fade-down">
            <div class="text-2xl font-bold text-slate-800 mb-6 font-orbitron tracking-wider">NERMAN.AI</div>
            <h1 class="text-4xl font-bold text-[#1E3A8A] mb-2 uppercase">Регистрация</h1>
        </div>

        <div class="glass-effect-reg rounded-[50px] p-10 md:p-12 shadow-2xl" data-aos="zoom-in">
            <?php if ($error): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div
                    class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm text-center">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-2 ml-1 cursor-default">Имя
                        пользователя</label>
                    <input type="text" name="username" required placeholder="examplenickname"
                        class="w-full px-6 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-2 ml-1 cursor-default">Gmail</label>
                    <input type="email" id="reg-email" name="email" required placeholder="example@gmail.com"
                        class="w-full px-6 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-2 ml-1 cursor-default">Пароль</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-6 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700">
                </div>

                <div class="relative">
                    <label class="block text-xs font-semibold text-slate-500 mb-2 ml-1 cursor-default">Код из
                        письма</label>
                    <input type="text" name="otp" required placeholder="555555"
                        class="w-full px-6 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700">
                    <div class="text-right mt-1">
                        <a href="javascript:sendOTP()" id="otp-btn"
                            class="text-[10px] text-slate-400 hover:text-blue-500 underline transition-colors">Отправить
                            код еще раз</a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white font-bold rounded-2xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all text-lg">Создать</button>

                <div class="flex items-center gap-4 py-1">
                    <div class="flex-1 h-[1px] bg-slate-200"></div>
                    <span class="text-slate-400 text-xs font-medium">или</span>
                    <div class="flex-1 h-[1px] bg-slate-200"></div>
                </div>

                <button type="button" onclick="alert('Tez orada...');" id="tg-login-btn"
                    class="w-full py-3 bg-[#24A1DE] text-white font-semibold rounded-2xl shadow-sm hover:bg-[#2192c9] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                    <i id="tg-icon" class="fa-brands fa-telegram text-xl"></i>
                    <span id="tg-text">Создать через Telegram</span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="login.php" class="text-xs text-blue-500 hover:underline">Уже есть аккаунт? Войти</a>
            </div>
        </div>
    </div>
</div>

<script>
    function sendOTP() {
        const email = document.getElementById('reg-email').value;
        if (!email) {
            alert('Пожалуйста, введите email');
            return;
        }
        const btn = document.getElementById('otp-btn');
        btn.textContent = 'Отправка...';
        btn.classList.add('pointer-events-none');

        // Mock call
        setTimeout(() => {
            alert('Код 555555 отправлен на ваш email');
            btn.textContent = 'Код отправлен';
        }, 1000);
    }
</script>

<?php include 'includes/footer.php'; ?>