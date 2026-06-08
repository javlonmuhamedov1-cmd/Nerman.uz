<?php
session_start();

function is_authenticated()
{
    return isset($_SESSION['user_id']);
}

function get_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

function get_user_subscription()
{
    return $_SESSION['subscription_type'] ?? 'None';
}

function login_user($user_id, $subscription_type)
{
    $_SESSION['user_id'] = $user_id;
    $_SESSION['subscription_type'] = $subscription_type;
}

function logout_user()
{
    session_unset();
    session_destroy();
}

function get_user_data($user_id)
{
    global $pdo;
    if (!$pdo)
        return null;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    } catch (Exception $e) {
        return null;
    }
}
?>