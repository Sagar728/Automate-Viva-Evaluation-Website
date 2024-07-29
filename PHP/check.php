<?php

include 'student_con.php';


$branch = $_POST['branch'] ?? '';
$subject = $_POST['subject'] ?? '';


if (!empty($branch) && !empty($subject)) {
   
    $sql = "SELECT question, answer FROM teacher_question WHERE branch = ? AND subject = ?";
    
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $branch, $subject);

   
    $stmt->execute();

    $stmt->bind_result($questionArray, $answerArray);
    
   
    $stmt->fetch();

   
    function safe_unserialize($string) {
        $data = @unserialize($string);
        if ($data === false && $string !== 'b:0;') {
            return null;
        }
        return $data;
    }


    $questions = safe_unserialize($questionArray);
    $answers = safe_unserialize($answerArray);
    

    
    if (!empty($questions) && !empty($answers)) {
       
        $randomIndex = array_rand($questions);
        $randomQuestion = $questions[$randomIndex];
        $randomAnswer = $answers[$randomIndex];
    

        
        echo "Question: $randomQuestion <br>";
      
       

       
        session_start();
        $_SESSION['randomAnswer'] = $randomAnswer;
        $_SESSION['randomQuestion'] = $randomQuestion;
      

    } else {
        
        echo "No questions found for the provided branch and subject.";
    }
} else {
  
    echo "Please provide both branch and subject.";
}
?>
