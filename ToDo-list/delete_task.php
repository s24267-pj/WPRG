<?php
session_start();

// Sprawdzanie czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('includes/db_connect.php');

// Sprawdzanie czy został przekazany identyfikator zadania
if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    // Usunięcie zadania z bazy danych
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param('i', $task_id);
    $stmt->execute();

    // Przekierowanie na dashboard.php po usunięciu zadania
}
header('Location: dashboard.php');
exit;