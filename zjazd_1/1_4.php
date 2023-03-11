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
<form name="formularz" action="1_4.php">
    <label for="a">Podaj liczbe a:</label>
    <input type="text" name="a" id="a"><br>

    <label for="b">Podaj liczbe b:</label>
    <input type="text" name="b" id="b"><br>

    <input type="submit">
</form>

<?php
if (isset($_GET['a']) && isset($_GET['b'])) {
    $liczba_a = (integer)$_GET['a'];
    $liczba_b = (integer)$_GET['b'];

    echo("Suma: ".$liczba_a + $liczba_b."<br>");
    echo("Różnica: ".$liczba_a - $liczba_b."<br>");
    echo("Mnożenie: ".$liczba_a * $liczba_b."<br>");
    echo("Dzielenie modulo: ".$liczba_a % $liczba_b."<br>");
}
?>
</body>
</html>


