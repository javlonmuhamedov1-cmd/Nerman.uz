<?php
require_once 'includes/db.php';

echo "<h2>Testing Database Connection...</h2>";

try {
    $stmt = $pdo->query("SELECT VERSION()");
    $version = $stmt->fetchColumn();
    echo "<p style='color: green;'>✅ Ulanish muvaffaqiyatli! MySQL versiyasi: " . $version . "</p>";

    // Check tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<h3>Mavjud jadvallar:</h3><ul>";
    if (empty($tables)) {
        echo "<li style='color: orange;'>⚠️ Jadvallar topilmadi! db/schema.sql faylini import qiling.</li>";
    } else {
        foreach ($tables as $table) {
            echo "<li>" . $table . "</li>";
        }
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Ulanishda xato: " . $e->getMessage() . "</p>";
    echo "<h4>Nima qilish kerak?</h4>";
    echo "<ul>
        <li>includes/db.php faylidagi login/parol/baza nomini tekshiring.</li>
        <li>Hostingizda Database User yaratilganligini va u bazaga biriktirilganligini tekshiring.</li>
        <li>Parolni ISPmanager orqali yangilab, db.php ga yozing.</li>
    </ul>";
}
?>