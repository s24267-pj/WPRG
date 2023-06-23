<?php
// Dane do połączenia z bazą danych
$host = 'db4free.net:3306'; // Adres hosta
$username = 'fantazyjny'; // Nazwa użytkownika bazy danych
$password = 'Osmiornica22'; // Hasło użytkownika bazy danych
$dbname = 'projekt_wprg'; // Nazwa bazy danych

// Nawiązanie połączenia z bazą danych
$conn = new mysqli($host, $username, $password, $dbname);

// Sprawdzenie czy połączenie zostało ustanowione
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Ustawienie kodowania znaków na UTF-8
$conn->set_charset("utf8");