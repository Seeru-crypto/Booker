<?php 

$filePath='C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\HTML_files\test.json';
$json_string = file_get_contents( $filePath);
$array = json_decode($json_string, true);


?>

<!DOCTYPE html>
<html lang="et">
    <head>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">

        <title>Autorite nimekiri</title>
    </head>
    <body>
        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
              <a class="navbar-brand" href="#">Booker</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
               
                  <li class="nav-item ">
                    <a class="nav-link" href="book-list.html">Raamatud <span class="sr-only">(current)</span></a>
                  </li>
           
                  <li class="nav-item active">
                    <a class="nav-link" href="author-list.php">Autorid</a>
                  </li>
                </ul>
              </div>
            </nav>
            </div>
            </nav>
            <!-- Sub navbar -->

            <div class="nav-scroller bg-secondary text-white box-shadow" style="padding-top: 55px;">
              <nav class="nav nav-underline">
                <a class="nav-link text-white" href="#">Import (Excel/ CSV)</a>
                <a class="nav-link text-white" href="#">Export</a>
                <a class="nav-link text-white" href="author-add.php">Lisa autor</a>
              </nav>
            </div>
          </header>

          <main role="main" class="container" style="padding-top: 60px;">
            
            <h1 style="padding-top: 60px;">Autorite nimekiri</h1> 
         
            <table class="table table-sm table-striped"> 
              <thead> 
                <tr>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>Review</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //$filePath='\HTML_files\test.json';
                  
                  $filePath='C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\HTML_files\test.json';
                  $json_string = file_get_contents( $filePath);
                  $array = json_decode($json_string);
                  foreach ($array as $value){?>
                  <tr>
                    <td><?php echo $value->firstName?></td>
                    <td><?php echo $value->lastName?></td>
                    <td><?php echo $value->authorReview?></td>
                  </tr>
                  <?php }  ?>

              </tbody>
            </table> 
          </main>
          <footer class="footer">
            <div class="container">
              <span class="text-muted">Fred Oja, 2021 Kevad semester</span>
            </div>
            <div class="col-md-12 text-center">
                          <a class="btn btn-primary btn-lg"  href="test.json" role="button">Autorid</a>
                          </div>>
          </footer>

  <!-- Include jQuery and other required files for Bootstrap -->
  <script src= 
  "https://code.jquery.com/jquery-3.3.1.min.js"> 
    </script> 
    <script src= 
  "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"> 
    </script> 
    <script src= 
  "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> 
    </script> 
    
    <!-- Include the JavaScript file for Bootstrap table -->
    <script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>

   

    </body>
</html>