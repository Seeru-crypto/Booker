<?php 
//http://localhost:8080/author-add.php


//Saving the data from the entered fields
  $firstName = isset($_POST['firstName'])
  ? $_POST['firstName']
  : '';

  $lastName = isset($_POST['lastName'])
  ? $_POST['lastName']
  : '';

  $AuthorReview = isset($_POST['AuthorReview'])
  ? $_POST['AuthorReview']
  : '';

$NameError ="";
$EntrySuccess="";
//testing if the name fields have been entered correctly
  if (is_numeric($firstName) || is_numeric($lastName)) {
    $NameError = 'Palun sisestage korrektne nimi';
    $firstName = $lastName=  "";
//if everything is ok, then proceed to writing

} else {
  $arr = array ($firstName, $lastName, $AuthorReview);
  $filePath='C:\Users\Red\Managment files\Veebitehnoloogiad_Repo\Booker\HTML_files\test.json';
  $additionalData= FormatDataToBeWritten($arr);
  $Originaldata = Read4File($filePath);
  $Originaldata[]=$additionalData;
  Write2File ($Originaldata, $filePath);
}
  $message ="";
  //$message = $firstName.$lastName.$AuthorReview;

  function FormatDataToBeWritten ($arr){
    $tags = array ("firstName", "lastName", "authorReview"); 
    return (array_combine ($tags, $arr));}

  function Read4File ($filePath){
      $str_Data = file_get_contents($filePath);
      return (json_decode($str_Data, true));}

  function Write2File ($data, $filePath){
      $fh = fopen($filePath, 'w')
          or die("Error opening output file");
      fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
      fclose($fh);}
?>

<!DOCTYPE html>
<html lang="et">
    <head>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Autorite lisamine</title>
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
               
                  <li class="nav-item">
                    <a class="nav-link" href="book-list.html">Raamatud <span class="sr-only">(current)</span></a>
                  </li>
           
                  <li class="nav-item active">
                    <a class="nav-link" href="author-list.php">Autorid</a>
                  </li>
                </ul>
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
          
            <h4 class="mb-3" style="padding-top: 60px;">Autori lisamine</h4>
<!--Autori eesnimi ja perenimi  -->

<form method="post" action="author-add.php">
              <div class="col-md-6 mb-3">
                <p class="font-weight-bold text-danger"><?php print $NameError?></p>
                <p class="font-weight-bold text-success"><?php print $EntrySuccess?></p>
                <label for="firstName">Eesnimi</label>
                <input type="text" class="form-control" name="firstName" placeholder="" value="<?php print $firstName?>" required="">
                <div class="invalid-feedback">
                  Palun sisestage kehtiv eesnimi.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Perenimi</label>
                <input type="text" class="form-control" name="lastName" placeholder="" value="<?php print $lastName?>" required="">
                <div class="invalid-feedback">
                  Palun sisestage kehtiv perekonnanimi.
                </div>
              </div>

<!--Autori hinnangu   -->
            <div class="col-md-2 mb-3" data-children-count="1">
              <label for="readState">Hinnang</label>
              <select class="custom-select d-block w-30" name="AuthorReview" required="">
                <option value="">Palun valige</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
              <div class="invalid-feedback">
                Viga
              </div>
            </div>
            <div class="col-md-12 text-center">            
              <input class="btn btn-primary btn-lg" type="submit" value="Lisage autor">
              </div>
          </form>
          <?php print $message;?>
          </main>




          <footer class="footer">
            <div class="container">
              <span class="text-muted">Fred Oja, 2021 Kevad semester</span>
            </div>
          </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>