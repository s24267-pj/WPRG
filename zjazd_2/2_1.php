<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<form name="formularz" action="2_1.php">
    <label for="a">Podaj liczbe a:</label>
    <input type="text" name="a" id="a"><br>

    <label for="b">Podaj liczbe b:</label>
    <input type="text" name="b" id="b"><br>

    <input type="radio" id="sum" name="operation" value="sum">
    <label for="sum">Sum</label><br>

    <input type="radio" id="substraction" name="operation" value="substraction">
    <label for="substraction">Substraction</label><br>

    <input type="radio" id="divide" name="operation" value="divide">
    <label for="divide">Divide</label><br>

    <input type="radio" id="multiply" name="operation" value="multiply">
    <label for="multiply">Multiply</label><br>


    <input type="submit">
</form>


<body>
<?php


if (isset($_GET['a']) && isset($_GET['b']) && isset($_GET['operation'])) {
    $liczba_a = (integer)$_GET['a'];
    $liczba_b = (integer)$_GET['b'];
    $operation = $_GET['operation'];

    switch ($operation) {
        case "sum":
            echo("Suma: " . $liczba_a + $liczba_b . "<br>");
            break;
        case "substraction":
            echo("Różnica: " . $liczba_a - $liczba_b . "<br>");
            break;
        case "multiply":
            echo("Mnożenie: " . $liczba_a * $liczba_b . "<br>");
            break;
        case "divide":
            if ($liczba_b == 0) {
                echo("Nie dziel przez 0!");
                break;
            } else {
                echo("Dzielenie: " . $liczba_a / $liczba_b . "<br>");
                break;
            }
        default:
            echo("Nie wybrałeś żadnej opcji.");

    }
}


?>
</body>
</html>