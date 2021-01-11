<?php

$file = 'C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\phpHarj\data\grades.txt';

$additionalData = ['history' => 5, 'chemistry' => 2];

foreach ($additionalData as $data => $value){
    $formatLine = "$data;$value".PHP_EOL;
    file_put_contents($file, $formatLine,FILE_APPEND);

}
print "Write complete!";

//file_put_contents('results.txt', 'some info',FILE_APPEND);