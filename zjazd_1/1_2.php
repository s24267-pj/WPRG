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
<form name="formularz" action="1_2.php">
    <label for="a">Podaj bok a:</label>
    <input type="text" name="a" id="a"><br>

    <label for="b">Podaj bok b:</label>
    <input type="text" name="b" id="b"><br>

    <input type="submit">
</form>

<?php
if (isset($_GET['a']) && isset($_GET['b'])) {
    $bok_a = $_GET['a'];
    $bok_b = $_GET['b'];

    echo($bok_a * $bok_b);
}
?>
</body>
</html>


