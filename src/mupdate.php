<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['id']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['transport']) && isset($_POST['duration']) && isset($_POST['languages']) && isset($_POST['price'])) {
        // Retrieve form data
        $id = $_POST['id'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $transport = $_POST['transport'];
        $duration = $_POST['duration'];
        $languages = $_POST['languages'];
        $price = $_POST['price'];

        // Prepare the update statement
        $update_sql = "UPDATE managetour SET country = ?, city = ?, transport = ?, duration = ?, languages = ?, price = ? WHERE id = ?";

        if ($stmt = $connection->prepare($update_sql)) {
            // Bind parameters (order matters!)
            $stmt->bind_param('ssssssi', $country, $city, $transport, $duration, $languages, $price, $id);

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