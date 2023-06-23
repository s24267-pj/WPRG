<?php
session_start();

// Sprawdzanie czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


require_once('includes/db_connect.php');

$user_id = $_SESSION['user_id'];

// Pobieranie listy zadań dla danego użytkownika
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);

// Obsługa dodawania nowego zadania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobieranie danych z formularza
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = 'pending'; // Ustawienie domyślnego statusu na "pending"

    // Tworzenie nowego zadania w bazie danych
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, status, created_at, updated_at)
                            VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param('isss', $user_id, $title, $description, $status);

    if ($stmt->execute()) {
        // Zadanie zostało dodane pomyślnie
        $_SESSION['success_message'] = 'Zadanie zostało dodane.';
    } else {
        // Wystąpił błąd podczas dodawania zadania
        $_SESSION['error_message'] = 'Wystąpił błąd. Spróbuj ponownie.';
    }
    header('Location: dashboard.php');
    exit;
}
// Obsługa usuwania zadania
if (isset($_POST['delete_task'])) {
    $task_id = $_POST['delete_task'];

    // Wykonaj operację usunięcia zadania z bazy danych
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param('i', $task_id);
    $stmt->execute();

    // Przekierowanie na dashboard.php po usunięciu zadania
    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Edytuj zadanie</title>
</head>
<body>
<h2>Twoje zadania</h2>

<!-- Wyświetlanie listy zadań -->
<?php if (count($tasks) > 0) : ?>
    <ul>
        <?php foreach ($tasks as $task) : ?>
            <li>
                <strong><?php echo $task['title']; ?></strong>
                <p><?php echo $task['description']; ?></p>
                <p>Status: <?php echo $task['status']; ?></p>
                <p>Data utworzenia: <?php echo $task['created_at']; ?></p>
                <p>Data aktualizacji: <?php echo $task['updated_at']; ?></p>
                <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edytuj</a>
                <!-- Przycisk "Usuń" -->
                <a href="delete_task.php?task_id=<?php echo $task['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunąć to zadanie?');">Usuń</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Brak zadań do wyświetlenia.</p>
<?php endif; ?>

<!-- Formularz do tworzenia nowego zadania -->
<h2>Dodaj nowe zadanie</h2>
<?php
if (isset($_SESSION['error_message'])) {
    echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}
?>
<form method="POST" action="dashboard.php">
    <label for="title">Tytuł:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Opis:</label>
    <textarea id="description" name="description" required></textarea>

    <button type="submit">Dodaj zadanie</button>
</form>

<!-- Przycisk "Pobierz listę zadań" -->
<p><a href="download_tasks.php" download class="button">Pobierz listę zadań</a>

<!-- Przycisk "Wyloguj" -->
    <a href="logout.php" class="button">Wyloguj</a></p>
</body>
</html>
