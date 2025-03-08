<?php
// Include database connection file
include 'connect.php'; // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted email
    $email = trim($_POST['email']);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL statement to insert the email
        $stmt = $conn->prepare("INSERT INTO mailing_list (email) VALUES (?)");

        if ($stmt) {
            $stmt->bind_param('s', $email);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Thank you for subscribing to our newsletter!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid email address. Please enter a valid email.";
    }

    // Close the database connection
    $conn->close();
}
?>
