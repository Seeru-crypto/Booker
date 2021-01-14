<?php 
//http://localhost:8080/c2f.html

$input = $_POST['temperature'];
$temperature1 = isset($input)
? $input //välja nimi, mille väärtus GET meetod saab
: ''; //vaikimisi väärdus

//input validation:

if (!empty($input) && !is_numeric($input)) {
    $messageF2C = 'The value must be an integer';
} if (empty($input)) {
    $messageF2C = 'Please enter a value';
} else {
    $tempCelsius = round (f2c($temperature1));
    $messageF2C = 'The inserted temperature in Celsius is '.$tempCelsius. " decrees";
}


function f2c ($temp){
    $temp = (int)$temp;
    return ($temp - 32) / (9/5);
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fahrenheit to Celsius</title>
</head>
<body>

    <nav>
        <a href="index.html">Celsius to Fahrenheit</a> |
        <a href="f2c.html">Fahrenheit to Celsius</a>
    </nav>

    <main>

        <h3>Fahrenheit to Celsius</h3>

        
        <?php print $messageF2C . '<br><br>';
        print 'The entered value is '.$temperature1; ?>

    </main>

</body>
</html>
