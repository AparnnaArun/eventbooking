<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking System</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <h1>Booking System</h1>
    <div class="row">
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
</div>
</div>
  <div class="container">
    <form id="filter-form">
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control" placeholder="Employee Name" id="employee" name="employee">
      
    </div>
    <div class="col-md-3">
      <input type="text" class="form-control" placeholder="Event Name" id="event" name="event">
         
    </div>
    <div class="col-md-3">
      <input type="date" class="form-control" placeholder="" id="date" name="date">
         
    </div>
    <div class="col-md-3">
        <button type="submit" value="" class="btn btn-primary">Filter</button>
         
    </div>
  </div>
</form>
   
  <div class="row mt-3">
    <table  class='table table-striped'>
       <thead>
    <tr>
     
      <th scope='col'>Employee</th>
      <th scope='col'>Event</th>
      <th scope='col'>Date</th>
      <th scope='col'>Fee</th>
    </tr>
  </thead>
  <tbody id="booking-table">
      

  </tbody>
  <tfoot>
      <tr>
          <td colspan="3"><b>Total Fee</b></td>
          <td class="totalfee"></td>
      </tr>
  </tfoot>
    </table>

    <div id="total-price"></div>
</div>
 </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     
 $(document).ready(function () {

  loadAllData(); // Initial load


            $("#filter-form").submit(function (e) {
                e.preventDefault();
                filterData();
            });
        });

        function loadAllData() {
            $.ajax({
                url: "fetch_data.php", 
                method: "GET",
                success: function (data) {
                    $("#booking-table").html(data);
                },
            });
        }

        function filterData() {
            var formData = $("#filter-form").serialize();
            $.ajax({
                url: "filter_data.php", 
                method: "POST",
                data: formData,
                success: function (data) {
                    $("#booking-table").html(data);
                },
            });
        }
    </script>
</body>
</html>
