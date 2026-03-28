<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['UPDid']) && isset($_POST['UPDusername']) && isset($_POST['UPDemail']) && isset($_POST['UPDcpass'])) {
        // Retrieve form data
        $UPDid = $_POST['UPDid'];
        $UPDusername = $_POST['UPDusername'];
        $UPDemail = $_POST['UPDemail'];
        $UPDcpass = $_POST['UPDcpass'];

        // Prepare the update statement
        $update_sql = "UPDATE signincustomer SET username = ?, email = ?, cpass = ? WHERE id = ?";

        if ($stmt = $connection->prepare($update_sql)) {
            // Bind parameters (order matters!)
            $stmt->bind_param('sssi', $UPDusername, $UPDemail, $UPDcpass, $UPDid);
            
            // Execute the query
            if ($stmt->execute()) {
                echo "<br>Data is Updated";
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $connection->error;
        }
    } else {
        echo "All form fields are required.";
    }
}

// Close the connection
$connection->close();
?>

