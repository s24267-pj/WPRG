<?php
session_start();

// Sprawdzanie czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
} else{
    header('Location: dashboard.php');
}
exit;