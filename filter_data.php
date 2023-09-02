<?php
   require_once 'config.php';

    $employeeName = '%' . $_POST['employee_name'] . '%';
    $eventName = '%' . $_POST['event_name'] . '%';
    $eventDate = $_POST['event_date'];

    $query = "SELECT * FROM eventbookings WHERE 1=1";
    $parameters = array();

    if (!empty($employeeName)) {
        $query .= " AND employee_name LIKE :employee_name";
        $parameters[':employee_name'] = "%$employeeName%";
    }

    if (!empty($eventName)) {
        $query .= " AND event_name LIKE :event_name";
        $parameters[':event_name'] = "%$eventName%";
    }

    if (!empty($eventDate)) {
        $query .= " AND event_date = :event_date";
        $parameters[':event_date'] = $eventDate;
    }

    // Prepare and execute SQL query
    $stmt = $pdo->prepare($query);
    $stmt->execute($parameters);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
         

       foreach ($results  as $row) {
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