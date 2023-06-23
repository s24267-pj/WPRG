<?php
// Połączenie z bazą danych
require_once 'includes/db_connect.php';

// Funkcja do generowania hasła zaszyfrowanego
function encryptPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Sprawdzenie czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sprawdzenie czy użytkownik o podanej nazwie już istnieje
    $checkQuery = "SELECT id FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "Użytkownik o podanej nazwie już istnieje!";
    } else {
        // Zaszyfrowanie hasła
        $hashedPassword = encryptPassword($password);

        // Dodanie nowego użytkownika do bazy danych
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Rejestracja zakończona sukcesem!";
            header("refresh:2; url=login.php");
            exit();
        } else {
            echo "Błąd podczas rejestracji: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>
<h1>Rejestracja</h1>
<form method="POST" action="">
    <label for="username">Nazwa użytkownika:
    <input type="text" name="username" required><br></label>

    <label for="password">Hasło:
    <input type="password" name="password" required><br></label>

    <input type="submit" value="Zarejestruj">
</form>
</body>
</html>
