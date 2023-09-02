<?php
   require_once 'config.php';

    

    // Handle form submission and build SQL query
    $employeeName = $_POST['employee_name'] ?? '';
    $eventName = $_POST['event_name'] ?? '';
    $eventDate = $_POST['event_date'] ?? '';

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

    // Output the filtered results in a table
    echo '<table>';
    echo '<tr><th>Employee Name</th><th>Event Name</th><th>Event Date</th><th>Fee</th></tr>';

    foreach ($results as $row) {
        echo "<tr><td>{$row['employee_name']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['participation_fee']}</td></tr>";
    }

    echo '</table>';

    // Calculate and output the total price
    $totalPrice = array_sum(array_column($results, 'participation_fee'));
    echo "<p>Total Price: <span id='total_price'>$totalPrice</span></p>";

?>
