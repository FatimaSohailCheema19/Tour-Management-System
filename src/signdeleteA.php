<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the ID field is set
    if (isset($_POST['ID'])) {
        // Retrieve form data
        $id = $_POST['ID'];

        // Prepare the delete statement
        $delete_sql = "DELETE FROM signinadmin WHERE id = ?";

        if ($stmt = $connection->prepare($delete_sql)) {
            // Bind the parameter
            $stmt->bind_param('i', $id);

            // Execute the query
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<br>Admin account with ID $id deleted successfully.";
                } else {
                    echo "<br>No record found with ID: $id";
                }
            } else {
                echo "Error deleting record: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $connection->error;
        }
    } else {
        echo "ID is required.";
    }
}

// Close the connection
$connection->close();
?>

