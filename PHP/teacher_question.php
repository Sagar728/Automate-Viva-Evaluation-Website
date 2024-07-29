<?php

include 'student_con.php';

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $branch = mysqli_real_escape_string($con, $_POST['branch']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
   
    // Initialize arrays to store questions and answers
    $questions = array();
    $answers = array();

    // Loop through the questions and answers and sanitize
    for ($i = 1; $i <= 10; $i++) {
        $question_key = 'q' . $i;
        $questions[$i] = mysqli_real_escape_string($con, $_POST[$question_key]);

        $answer_key = 'a' . $i;
        $answers[$i] = mysqli_real_escape_string($con, $_POST[$answer_key]);

       
    }

    // Serialize questions and answers arrays
    $serialized_questions = serialize($questions);
    $serialized_answers = serialize($answers);
   

    $idquery = "SELECT * FROM teacher_question WHERE id='$id'";
    $query = mysqli_query($con, $idquery);
    $idcount = mysqli_num_rows($query);

    if($idcount > 0) {
        ?>
        <script>
            alert("ID Already Exists");
            location.href = 'teacher_portal.html';
        </script>
        <?php
    } else {
        $insertquery = "INSERT INTO teacher_question (name, id, branch, subject, question, answer ) VALUES ('$name', '$id', '$branch', '$subject', '$serialized_questions', '$serialized_answers' )";
        $iquery = mysqli_query($con, $insertquery);

        if($iquery) {
            ?>
            <script>
                alert("Submitted Successfully");
                location.href = 'teacher_portal.html';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Connection Lost");
            </script>
            <?php
        }
    }
}
?>
