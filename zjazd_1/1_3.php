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
<form name="formularz" action="1_3.php">
    <label for="a">Podaj liczbe a:</label>
    <input type="text" name="a" id="a"><br>

    <input type="submit">
</form>



<?php

if (isset($_GET['a'])) {
    $a = $_GET['a'];
    echo(round(sqrt($a),2));
}

?>
</body>
</html>