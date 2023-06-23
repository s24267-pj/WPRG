<?php
session_start();

// Usuń wszystkie dane sesji
session_unset();
// Zniszcz sesję
session_destroy();

// Przekieruj użytkownika na stronę logowania
echo nl2br("Zostałeś poprawnie wylogowany.\nZaraz zostaniesz przekierowany...");
header("refresh:2; url=login.php");
exit();