<?php

$servername = "localhost";
$username = "aarti_user";
$password = "contact123";
$dbname = "AARTI_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data
    $sql = "INSERT INTO student_contacts (name, email, message)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<h2>Contact saved successfully!</h2>";
        echo "<p>Thank you, $name.</p>";
        echo "<a href='contact.html'>Go back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "Invalid request.";
}

$conn->close();

?>
