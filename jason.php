<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Event Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-5">
   <div class="card">
     <h2 class="card-title text-center">Upload your Jason File Here</h2>
      <div class="card-body py-md-4">
        <?php
     
if(isset($_SESSION['status'])){
  ?>
  <div class="alert alert-success" role="alert">
<?php echo $_SESSION['status'];
unset ($_SESSION['status']);
}
?>
</div>
<?php
 if(isset($_SESSION['failed'])){
  ?>
  <div class="alert alert-danger" role="alert">
<?php echo $_SESSION['failed'];
unset ($_SESSION['failed']);
}
 ?>
</div>
  

       <form _lpchecked="1" action="readjason.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
        
             <input type="file" name="jsonFile" class="form-control" id="jsonFile" accept=".json" required>
        </div>
      
       <div class="d-flex flex-row align-items-center justify-content-between">
        <button type="submit" class="btn btn-primary">Upload</button>
        
          </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>
</body>
</html>