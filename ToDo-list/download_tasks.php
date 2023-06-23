<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('includes/db_connect.php');

$user_id = $_SESSION['user_id'];

// Pobranie listy zadań dla danego użytkownika
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();

// Generowanie zawartości pliku z listą zadań
$fileContent = "Lista zadań:\n\n";
foreach ($tasks as $task) {
    $fileContent .= "Tytuł: " . $task['title'] . "\n";
    $fileContent .= "Opis: " . $task['description'] . "\n";
    $fileContent .= "Status: " . $task['status'] . "\n";
    $fileContent .= "Data utworzenia: " . $task['created_at'] . "\n";
    $fileContent .= "Data aktualizacji: " . $task['updated_at'] . "\n\n";
}

// Ustawienia nagłówków do pobrania pliku
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="tasks.txt"');

// Wyświetlenie zawartości pliku i zakończenie skryptu
echo $fileContent;
exit;