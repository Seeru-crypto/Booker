<?php

    $input = isset($_POST['temperature'])
        ? $_POST['temperature']
        : '';

    if (!empty($input) && !is_numeric($input)) {
        $message = 'The value must be an integer';
    } else if (!empty($input)) {
        $message = 'Input was: ' . $input;
    } else {
        $message = 'Insert temperature in Celsius';
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Validate form</title>
</head>
<body>

<h3>Validate form</h3>

<form method="post" action="validate.php">

    <?php print $message . '<br><br>'; ?>

    <input name="temperature" value="<?php print $input ?>">

    <br>
    <br>

    <input type="submit" value="Calculate"/>

</form>

</body>
</html>
