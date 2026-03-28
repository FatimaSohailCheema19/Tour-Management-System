<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['UPDusername']) && isset($_POST['UPDemail']) && isset($_POST['UPDapass'])) {
        $UPDusername = $_POST['UPDusername']; // Fetch the form field
        $UPDemail = $_POST['UPDemail'];       // Fetch the form field
        $UPDapass = $_POST['UPDapass'];       // Fetch the form field

        // Fetch the last record from the database
        $fetch_sql = "SELECT * FROM signinadmin ORDER BY id DESC LIMIT 1";
        $result = $connection->query($fetch_sql);

        if ($result->num_rows > 0) {
            $last_record = $result->fetch_assoc();
            $last_id = $last_record['id'];

            // Update the record based on the fetched ID
            $update_sql = "UPDATE signinadmin SET username = '$UPDusername', email = '$UPDemail', apass = '$UPDapass' WHERE id = '$last_id'";

            if ($connection->query($update_sql)) {
                echo "<br>Data is Updated";
            } else {
                echo "Data is not updated: " . $connection->error;
            }
        } else {
            echo "No records found in the database.";
        }
    } else {
        echo "All form fields are required.";
    }
}

$connection->close();
?>


