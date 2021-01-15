<?php 
$filePath=include"$_SERVER[DOCUMENT_ROOT]/HTML_files/test.json";
//$filePath='C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\HTML_files\test.json';
$arr = array("", "", );

$additionalData= FormatDataToBeWritten($arr);
$Originaldata = Read4File($filePath);

$Originaldata[]=$additionalData;
Write2File ($Originaldata, $filePath);


function FormatDataToBeWritten ($arr){
    $tags = array ("firstName", "LastName", "ID"); 
    return (array_combine ($tags, $arr));}
function Read4File ($filePath){
    $str_Data = file_get_contents($filePath);
    return (json_decode($str_Data, true));
}



function Write2File ($data, $filePath){
    $fh = fopen($filePath, 'w')
        or die("Error opening output file");
    fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
    fclose($fh);
    echo ("done");
  }
  