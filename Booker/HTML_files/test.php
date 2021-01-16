<?php 
$filePath='C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\HTML_files\test.json';
$arr = array("", "", );



Data4API();

//$additionalData= FormatDataToBeWritten($arr);
//$Originaldata = Read4File($filePath);

//$Originaldata[]=$additionalData;
//Write2File ($Originaldata, $filePath);

function Data4API (){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.appery.io/rest/1/apiexpress/api/QueryFolder/EndGroup/1?apiKey=213e6072-009c-4bd3-98b2-6d075c9bef7f",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
    

$response = json_decode($response, true); //because of true, it's in an array
echo 'Online: '. $response['AuthorID']['FirstName'];


}

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
  



