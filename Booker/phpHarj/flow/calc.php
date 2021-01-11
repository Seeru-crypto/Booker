<?php
    $TempInCel = $_POST['temperature'];
    function GetF ($data){
        $F = ($data * 1.8) +32;
        return $F;
    }
?>

<!DOCTYPE html>
<html lang="et">
 <head>
 <meta charset="utf-8">
 <title>Php test</title>
 </head>
 <body>
     <h1>Temperatuuri teisendamine</h1>
     <p>Algne temperatuur on celsius. 
         <?php 
            print $TempInCel."\n";
         ?>
    </p>
     <p>
        Teisenduse tulemus on Farenheit
            <?php 
                $F = GetF ($TempInCel);
                print($F); 
            ?>.

     </p>
 </body>
</html>

