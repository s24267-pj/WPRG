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
    <form name="formularz" action="calc.php">
        <label for="a">Podaj liczbe a:</label>
        <input type="text" name="a" id="a"><br>

        <label for="b">Podaj liczbe b:</label>
        <input type="text" name="b" id="b"><br>

        <label for="dzialanie">Wybierz działanie:</label>
        <select name="dzialanie" id="dzialanie">
        <option value="sum">Dodawanie</option>
        <option value="sub">Odejmowanie</option>
        <option value="multiply">Mnożenie</option>
        <option value="modulo">Dzielenie modulo</option>

    </select><br>


        <input type="submit">
    </form>

    <?php
    if (isset($_GET['a']) && isset($_GET['b'])) {
        $liczba_a = (integer)$_GET['a'];
        $liczba_b = (integer)$_GET['b'];

        switch ($_GET['dzialanie']) {
            case 'sum':
                include 'sum.php';
                echo("Suma: " . sum($liczba_a, $liczba_b) . "<br>");
                break;
            case 'sub':
                include 'sub.php';
                echo("Różnica: " . sub($liczba_a, $liczba_b) . "<br>");
                break;
            case 'multiply':
                include 'multiply.php';
                echo("Mnożenie: " . multiply($liczba_a, $liczba_b) . "<br>");
                break;
            case 'modulo':
                include 'modulo.php';
                echo("Dzielenie modulo: " . modulo($liczba_a, $liczba_b) . "<br>");
                break;
            default:
                echo "Nieprawidłowe działanie";
        }
    }
    ?>
</body>
</html>
