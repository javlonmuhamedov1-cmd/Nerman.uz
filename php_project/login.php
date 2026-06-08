<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

if (is_authenticated()) {
    header("Location: index.php");
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $profile_stmt = $pdo->prepare("SELECT subscription_type FROM profiles WHERE user_id = ?");
        $profile_stmt->execute([$user['id']]);
        $profile = $profile_stmt->fetch();

        login_user($user['id'], $profile['subscription_type'] ?? 'None');
        header("Location: index.php");
        exit;
    } else {
        $error = "Неверный email или пароль";
    }
}

$page_title = 'Вход — NERMAN.AI';
$hide_header = false;
$hide_footer = true;
include 'includes/header.php';
?>

<style>
    .glass-effect-login {
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

<div class="min-h-[80vh] relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blob-1 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] bg-blob-2 pointer-events-none"></div>

    <div class="w-full max-w-[480px] z-10">
        <div class="text-center mb-10" data-aos="fade-down">
            <div class="text-2xl font-bold text-slate-800 mb-6 font-orbitron tracking-wider">NERMAN.AI</div>
            <h1 class="text-5xl font-bold text-[#1E3A8A] mb-2 uppercase">Вход</h1>
        </div>

        <div class="glass-effect-login rounded-[50px] p-10 md:p-14 shadow-2xl" data-aos="zoom-in">
            <?php if ($error): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-500 mb-2 ml-1 cursor-default">Gmail</label>
                    <input type="email" name="email" required placeholder="example@gmail.com"
                        class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700">
                </div>

                <div class="relative">
                    <label class="block text-sm font-semibold text-slate-500 mb-2 ml-1 cursor-default">Пароль</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="Пароль"
                            class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700 pr-14">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                            <i id="password-eye" class="fa-regular fa-eye text-xl"></i>
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <a href="register.php" class="text-xs text-blue-500 hover:underline">Нет аккаунта?
                        Зарегистрироваться</a>
                </div>

                <button type="submit"
                    class="w-full py-5 bg-gradient-to-r from-[#157BFF] to-[#15488B] text-white font-bold rounded-2xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all text-lg">Войти</button>

                <div class="flex items-center gap-4 py-2">
                    <div class="flex-1 h-[1px] bg-slate-200"></div>
                    <span class="text-slate-400 text-sm font-medium">или</span>
                    <div class="flex-1 h-[1px] bg-slate-200"></div>
                </div>

                <button type="button" onclick="alert('Tez orada...');" id="tg-login-btn"
                    class="w-full py-4 bg-[#24A1DE] text-white font-semibold rounded-2xl shadow-sm hover:bg-[#2192c9] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                    <i id="tg-icon" class="fa-brands fa-telegram text-2xl"></i>
                    <span id="tg-text">Войти через Telegram</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const eye = document.getElementById('password-eye');
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }
    }
</script>

<?php include 'includes/footer.php'; ?>