<?php
session_start();

// Sprawdzanie czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('includes/db_connect.php');

// Sprawdzanie czy został przekazany identyfikator zadania
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Pobieranie informacji o zadaniu z bazy danych
    $query = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $task = $result->fetch_assoc();
    } else {
        // Jeśli nie znaleziono zadania o podanym identyfikatorze, przekierowanie do dashboard.php
        header('Location: dashboard.php');
        exit;
    }

    $stmt->close();
} else {
    // Jeśli nie został przekazany identyfikator zadania, przekierowanie do dashboard.php
    header('Location: dashboard.php');
    exit;
}

// Sprawdzanie czy został przesłany formularz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Aktualizacja zadania w bazie danych
    $query = "UPDATE tasks SET title = ?, description = ?, status = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $title, $description, $status, $task_id);
    $stmt->execute();

    // Przekierowanie do dashboard.php po zaktualizowaniu zadania
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
<h1>Edytuj zadanie</h1>
<form method="POST">
    <label>Tytuł:
    <input type="text" name="title" value="<?php echo $task['title']; ?>"><br></label>
    <label>Opis:
    <textarea name="description"><?php echo $task['description']; ?></textarea><br></label>
    <label>Status:
    <select name="status">
        <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Oczekujące</option>
        <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Zakończone</option>
    </select><br></label>
    <input type="submit" value="Zapisz">
</form>
</body>
</html>
