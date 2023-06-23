<?php
session_start();

// Sprawdź, czy użytkownik jest już zalogowany
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sprawdź poprawność danych logowania
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Zalogowano pomyślnie - ustaw zmienne sesyjne
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Przekieruj do strony dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Niepoprawne dane logowania
        $error = "Niepoprawna nazwa użytkownika lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Logowanie</title>
</head>
<body>
<h2>Logowanie</h2>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Nazwa użytkownika:
    <input type="text" name="username" required><br><br></label>
    <label for="password">Hasło:
    <input type="password" name="password" required><br><br></label>
    <input type="submit" value="Zaloguj" class="button">
</form>

<!-- Przycisk "Rejestracja" -->
<a href="register.php" class="button">Rejestracja</a>
</body>
</html>
