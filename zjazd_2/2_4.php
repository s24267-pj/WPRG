<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $number = isset($_POST['number']) ? (int) $_POST['number'] : null;
  $iterations = 0;
  
  if ($number !== null && is_int($number) && $number > 0) {
    $is_prime = true;
    for ($i = 2; $i <= sqrt($number); $i++) {
      $iterations++;
      if ($number % $i === 0) {
        $is_prime = false;
        break;
      }
    }
    if ($is_prime) {
      echo $number . ' jest liczbą pierwszą.';
    } else {
      echo $number . ' nie jest liczbą pierwszą.';
    }
    echo ' Wykonano ' . $iterations . ' iteracji.';
  } else {
    echo 'Podaj poprawną liczbę całkowitą dodatnią.';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sprawdź, czy liczba jest liczbą pierwszą</title>
</head>
<body>
  <form method="post">
    <label>
      Podaj liczbę:
      <input type="text" name="number">
    </label>
    <button type="submit">Sprawdź</button>
  </form>
</body>
</html>
