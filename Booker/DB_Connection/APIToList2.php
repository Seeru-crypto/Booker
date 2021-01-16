<?php 


$api_url = 'https://api.appery.io/rest/1/apiexpress/api/QueryFolder/GetAllData/1?apiKey=213e6072-009c-4bd3-98b2-6d075c9bef7f';

//$api_url = 'http://dummy.restapiexample.com/api/v1/employees';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->data;

// Cut long data into small & select only first 10 records
$user_data = array_slice($user_data, 0, 9);

// Print data if need to debug
print ("example of imported API array\n");
print_r($user_data[0]);

?>



<!DOCTYPE html>
<html lang="et">
    <head>
</head>
<body>
    <table > 
              <thead> 
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Age</th>
                </tr>
              </thead>
              <tbody>
                <?php 
              
                  foreach ($user_data as $value){?>
                  <tr>
                    <td><?php echo $value->id?></td>
                    <td><?php echo $value->employee_name?></td>
                    <td><?php echo $value->employee_age?></td>
                  </tr>
                  <?php }  ?>
              </tbody>
            </table> 
</body>
</html>

