<?php
if(isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['email'])) {
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$email = $_POST['email'];
	$dane = $imie . ',' . $nazwisko . ',' . $email . "\n";
	
	$plik = fopen("dane.txt", "a");
	fwrite($plik, $dane);
	fclose($plik);
	echo "Dane zostały zapisane!";
} else {
	echo "Wystąpił błąd! Wszystkie pola muszą być wypełnione!";
}
?>
