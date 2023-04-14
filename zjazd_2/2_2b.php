<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  color: #333;
  line-height: 1.5;
}

h1 {
  font-size: 28px;
  margin-top: 40px;
}

p {
  margin: 20px 0;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  margin-bottom: 10px;
}

  </style>
    <title>Podsumowanie rezerwacji</title>
</head>
<body>
<?php
if (isset($_GET['guestNumber']) && isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['adres']) && isset($_GET['arrival'])) {
    $guestNumber = $_GET['guestNumber'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $adres = $_GET['adres'];
    $arrival = strtotime($_GET['arrival']);
    $departure = strtotime($_GET['departure']);
    $bed = isset($_GET['bed']) && $_GET['bed']  ? "1" : "0";
    
    if (isset ($_GET['options'])){ $options = $_GET['options'];}

    if ($guestNumber == 1){
        $guestText = "1 gościa";
    } else {
        $guestText = $guestNumber . " gości";
    }

    $stayDays = ($departure - $arrival) / 86400;

    // Sprawdzenie, czy wybrane zostały jakieś opcje
    if (empty($options)) {
        $optionsText = "Brak dodatkowych opcji.";
    } else {
        $optionsText = implode(", ", $options);
    }

    // Sprawdzenie, czy łóżko dla dziecka ma być dostawione
    if ($bed) {
        $bedText = "Tak";
    } else {
        $bedText = "Nie";
    }

    // Wyświetlenie podsumowania rezerwacji
    echo <<<HTML
        <h1>Podsumowanie rezerwacji</h1>
        <p>Rezerwacja dla $guestText:</p>
        <ul>
            <li>Imię: <strong>$fname</strong></li>
            <li>Nazwisko: <strong>$lname</strong></li>
            <li>Adres: <strong>$adres</strong></li>
            <li>Data przyjazdu: <strong>{$_GET['arrival']}</strong></li>
            <li>Data wyjazdu: <strong>{$_GET['departure']}</strong></li>
            <li>Liczba dni pobytu: <strong>$stayDays</strong></li>
            <li>Dostawione łóżko dla dziecka: <strong>$bedText</strong></li>
            <li>Wybrane opcje: <strong>$optionsText</strong></li>
        </ul>
    HTML;
}
?>
</body>
</html>
