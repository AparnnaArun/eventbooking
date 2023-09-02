<?php
// connecting to db
        require_once 'config.php';

//Fetch data from db

         $sql = "SELECT  employee_name, event_name, event_date, participation_fee 
            FROM eventbookings";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($rows) > 0) {
         

       foreach ($rows as $row) {
            echo "<tr>";
            echo "<td scope='row'>".$row['employee_name']."</td>";
            echo "<td>".$row['event_name']."</td>";
            echo "<td>".$row['event_date']."</td>";
            echo "<td class='fee'>".$row['participation_fee']."</td>";
           

        }
        
       
    } else {
          echo "<tr>";
        echo "<td scope='row' colspan='4' style='color:red;text-align:center'><b>".'OOPS!!!! No results found'."</b></td>";
         echo "</tr>";
    }

?>

<!-- To Calculate the total participation fee using jquery -->
<script type="text/javascript">
     $(document).ready(function () {
     var sum = 0;
  $(".fee").each(function(){
    //alert("hai");
    sum += parseFloat($(this).text());
    //alert(sum);
  });
  $('.totalfee').text(sum.toFixed(2));
});
</script>