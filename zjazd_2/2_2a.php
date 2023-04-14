<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form name="formularz" action="2_2b.php">

    <label for="guestNumber">Wybierz ilość gości:</label>

    <select name="guestNumber" id="guestNumber">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>

    <br><br>

    <fieldset>
        <legend>Dane osoby rezerwującej pobyt</legend>
        <label for="fname">Imię:</label>
        <input type="text" id="fname" name="fname" required="required"><br><br>
        <label for="lname">Nazwisko:</label>
        <input type="text" id="lname" name="lname" required="required"><br><br>
        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" required="required"><br><br>

    </fieldset>
    <fieldset>
        <legend>Dane pobytu:</legend>
        <label for="arrival">Data przybycia:</label>
        <input type="date" id="arrival" name="arrival" required="required"><br><br>
        <label for="departure">Data wyjazdu:</label>
        <input type="date" id="departure" name="departure" required="required"><br><br>
    </fieldset>

    <fieldset>
        <legend>Opcje</legend>
        <label for="bed">Dostawić łóżko dla dziecka?</label>
        <input type="checkbox" name="bed" id="bed" value="1"><br><br>

        <label for="options">Wybierz dodatkowe opcje:</label>
        <select name="options[]" id="options" multiple="multiple">
            <option value="brak" selected="selected">Brak</option>
            <option value="klimatyzacja">Klimatyzacja</option>
            <option value="popielniczka">Popielniczka</option>
            <option value="alkohol">Alkohol</option>
            <option value="lodówka">Lodówka</option>
        </select>
    </fieldset>

    <br>
    <input type="submit">
</form>

<?php


if (isset($_GET['guestNumber']) && isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['adres']) && isset($_GET['arrival'])) {
    $guestNumber = $_GET['guestNumber'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $adres = $_GET['adres'];
    $arrival = strtotime($_GET['arrival']);
    $departure = strtotime($_GET['departure']);
    $bed = isset($_GET['bed']) && $_GET['bed']  ? "1" : "0";
    $options = $_GET['options'];

    if ($guestNumber == 1){
        echo("<h1>Nowa rezrwacja dla 1 gościa.</h1>");
    } else {
        echo("<h1>Nowa rezrwacja dla ".$guestNumber." gości.</h1>");
    }

    echo("<p><b>" . $fname . " " . $lname . "</b> złożył/a nową rezerwację w naszym hotelu. </p>");
    echo("<p> Dane adresowe osoby rezerwującej: </p>");

    echo("Pobyt od " . $_GET['arrival'] . " do " . $_GET['departure'] . ". Razem " . ($departure - $arrival) / 86400 . " dni.");








}


?>
</body>
</html>