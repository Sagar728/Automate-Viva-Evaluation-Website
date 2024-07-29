<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['image_id']) && !empty($_GET['image_id'])) {
    $image_id = $_GET['image_id'];

    // Prepare and execute the SQL query to retrieve the image data
    $sql = "SELECT image FROM `check` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if image data is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_data = $row['image'];

        // Display the image
        header('Content-Type: image/jpeg');
        echo $image_data;
    } else {
        echo "Image not found.";
    }
} else {
    echo "Invalid image ID.";
}

$stmt->close();
$conn->close();
?>
