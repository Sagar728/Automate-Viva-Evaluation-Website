<?php
// Database connection variables
$host = 'localhost';
$username = 'root';  // Replace with your MySQL/MariaDB username
$password = '';  // Replace with your database password
$database = 'student';        // Database name is 'student'

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the PDF file's path is to be stored in the 'pdf_file' column
$filePath = "uploads/" . basename($_FILES["fileInput"]["name"]);

// Prepare SQL statement to insert file path into the 'check' table
$sql = "INSERT INTO `check` (pdf_file) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $filePath);

// Execute the query and check for success
if ($stmt->execute()) {
    echo "Record saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
