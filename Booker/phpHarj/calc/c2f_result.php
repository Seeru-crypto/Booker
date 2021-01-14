<?php 
//http://localhost:8080/c2f.html
    $input = $_POST['temperature'];
    $temperature2 = isset($input)
    ? $input //välja nimi, mille väärtus GET meetod saab
    : ''; //vaikimisi väärdus

//input validation:
    //If the entered value is not numeric and not empty

    if (!empty($input) && !is_numeric($input)) {
        $messageC2F = 'The value must be an integer';
    }
        //If the entered value is empty
    if (empty($input)) {
        $messageC2F = 'Please enter a value';
    }
    else {
        $tempFarhenheit = c2f($temperature2);
        $messageC2F = 'The inserted temperature in is '.$tempFarhenheit." decrees";
    }


    function c2f ($temp){
        $temp = (int)$temp;
        return $temp * 9/5 + 32;
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Celsius to Fahrenheit</title>
</head>
<body>
    

    <nav>
        <a href="index.html">Celsius to Fahrenheit</a> |
        <a href="f2c.html">Fahrenheit to Celsius</a>
    </nav>

    <main>

        <h3>Celsius to Fahrenheit</h3>

        <?php print $messageC2F . '<br><br>';
        print 'The entered value is '.$temperature2; ?>

    </main>

</body>
</html>
