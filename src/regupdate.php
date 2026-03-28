<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['tourdate']) && isset($_POST['participants'])) {
        // Retrieve form data
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $tourdate = $_POST['tourdate'];
        $participants = $_POST['participants'];
        $message = isset($_POST['message']) ? $_POST['message'] : ''; // Optional field

        // Prepare the update statement
        $update_sql = "UPDATE registration SET name = ?, email = ?, phone = ?, tourdate = ?, participants = ?, message = ? WHERE id = ?";

        if ($stmt = $connection->prepare($update_sql)) {
            // Bind parameters (order matters!)
            $stmt->bind_param('ssssssi', $name, $email, $phone, $tourdate, $participants, $message, $id);

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

