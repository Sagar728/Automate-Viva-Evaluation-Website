
<?php

include 'student_con.php' ;

if(isset($_POST['submit']))
{

   
   $email = mysqli_real_escape_string($con,$_POST['email']);
   $password = mysqli_real_escape_string($con,$_POST['password']);


   $query = "SELECT * FROM student_credencial WHERE email = '$email' AND password = '$password'";
   $result = mysqli_query($con, $query);

   if(mysqli_num_rows($result) == 1) {
    ?>

    <script>
    alert("Login Successfully");
    location.href = 'student_portal.html';
    </script>

    <?php
   } else {
    ?>

    <script>
    alert("Please Enter your valid Email and Password");
    location.href = 'student_sign.html';
    </script>

    <?php
   }
}

   
   

?>
