<?php

// Check if a JSON file was uploaded correctly

if (isset($_FILES['jsonFile']) && $_FILES['jsonFile']['error'] === UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['jsonFile']['tmp_name'];

    // Check if the uploaded file is a valid JSON file
    
    $jsonContent = file_get_contents($uploadedFile);
    $jsonData = json_decode($jsonContent, true);

    if ($jsonData !== null) {
        
        // connecting to db
        require_once 'config.php';

            // Insert the JSON data into the database 
            $stmt = $pdo->prepare("INSERT INTO eventbookings (participation_id, event_id, employee_name, employee_mail,event_name,event_date,version,participation_fee) VALUES (:participation_id, :event_id, :employee_name, :employee_mail,:event_name,:event_date,:version,:participation_fee)");

    foreach ($jsonData as $booking) {
        $stmt->bindParam(':participation_id', $booking['participation_id']);
        $stmt->bindParam(':event_id', $booking['event_id']);
        $stmt->bindParam(':employee_name', $booking['employee_name']);
        $stmt->bindParam(':employee_mail', $booking['employee_mail']);
        $stmt->bindParam(':event_name', $booking['event_name']);
        $stmt->bindParam(':event_date', $booking['event_date']);
        $stmt->bindParam(':version', $booking['version']);
        $stmt->bindParam(':participation_fee', $booking['participation_fee']);
        $stmt->execute();

           
        } 
         echo "Data uploaded successfully.";
        
    } else {
        echo "The uploaded file is not a valid JSON file.";
    }
} else {
    echo "Error uploading the JSON file.";
}
?>
