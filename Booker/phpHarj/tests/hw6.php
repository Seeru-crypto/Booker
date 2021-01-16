<?php

require_once('common.php');

if ($argc < 4) {
    die('Pass project directory, userName and secret as arguments.' . PHP_EOL);
} else {
    $path = realpath($argv[1]);
    $userName = $argv[2];
    $secret = $argv[3];
}

if ($path === false) {
    die('Path is not a correct directory.' . PHP_EOL);
}

$dataFile = "$path/hw6.txt";

if (!file_exists($dataFile)) {
    die("can't find hw6.txt from $path" . PHP_EOL);
}

$lines = file($dataFile);

$dict = [];

foreach ($lines as $line) {
    if (!trim($line)) {
        continue;
    }

    $pair = explode('=', $line);
    if (count($pair) === 2) {
        list ($key, $value) = $pair;
        $dict[trim($key)] = trim($value);
    }
}

$errors = [];

foreach (range(1, 14) as $nr) {

    $key = strval($nr);
    $actualValue = isset($dict[$key]) ? $dict[$key] : '';

    if (empty($actualValue)) {
        $errors[] = ("Token for exercise $nr is missing");
    } else if (!isValid($nr, $userName, $actualValue)) {
        $errors[] = ("Incorrect token for exercise $nr");
    }
}

if (empty($errors)) {

    printf(RESULT_PATTERN, MAX_POINTS, MAX_POINTS);

} else {
    print join(PHP_EOL, $errors);

    die(sprintf(RESULT_PATTERN, 0, MAX_POINTS));
}

function isValid($nr, $userName, $actualValue) {
    global $secret;

    $hash = sha1($nr . $userName . $secret);
    $hash2 = sha1($nr . $hash . $secret);

    return $actualValue === $hash || $actualValue === $hash2;
}
