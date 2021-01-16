<?php

$data = GetDataFromFile();
$grades = TransformDataIntoArray($data);
$AverageGrade = GetAverageGrade($grades);
echo $AverageGrade;

function GetDataFromFile (){
    $file = 'C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\phpHarj\data\grades.txt';
    $FileArrays = file($file);
    echo ("read file: ");
    foreach ($FileArrays as $value){
        echo $value;
    }
    return $FileArrays;
}

function TransformDataIntoArray ($data){
    $grades=[];
    $subjects=[];
    foreach ($data as $value){
        $StringPart=(explode(";",trim($value)));
        array_push ($grades, $StringPart[1]);
        array_push ($subjects, $StringPart[0]);
        }
        return $grades;
    }

    function GetAverageGrade($grades){
        $totalNrOfGrades = count ($grades);
        $SumOfGrades= 0;
        foreach ($grades as $grade){
            $SumOfGrades += $grade;
        }
        $Average= $SumOfGrades / $totalNrOfGrades;
        return $Average;
    }




