<?php
$host = 'localhost'; // or your host
$username = 'root'; // your database username
$password = ''; // your database password
$database = 'student';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit']) && isset($_FILES['pdfFile'])) {
    $pdfFile = $_FILES['pdfFile'];

    // Check if the file is a PDF
    if ($pdfFile['type'] != 'application/pdf') {
        echo "Please upload a PDF file.";
        exit;
    }

    // Read the file
    $pdfData = file_get_contents($pdfFile['tmp_name']);
    $pdfData = $conn->real_escape_string($pdfData); // Escaping binary data

    // SQL query
    $query = "INSERT INTO `check` (pdf_file) VALUES ('{$pdfData}')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo "PDF uploaded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
