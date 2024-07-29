<?php
include 'student_con.php';

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $branch = mysqli_real_escape_string($con, $_POST['branch']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $result = mysqli_real_escape_string($con, $_POST['result']);
    $image = mysqli_real_escape_string($con, $_POST['image']);

    session_start();
    $randomAnswer = $_SESSION['randomAnswer'];
    $randomQuestion = $_SESSION['randomQuestion'];
    
 
    $insertquery = "INSERT INTO `check` (id, branch, subject, question, result, answer,image) VALUES (?, ?, ?, ?, ?, ?,?)";

   
    if ($stmt = mysqli_prepare($con, $insertquery)) {
     
        mysqli_stmt_bind_param($stmt, "sssssss", $id, $branch, $subject, $randomQuestion, $result, $randomAnswer,$image);
        
     
        $iquery = mysqli_stmt_execute($stmt);
        
        if ($iquery) {
            ?>
            <script>
                alert("Submit successfully");
                location.href = 'marks.php';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Connection Lost");
            </script>
            <?php
        }
    } else {
        
        echo "Error preparing statement.";
    }
}
?>
