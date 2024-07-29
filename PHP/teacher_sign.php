
<?php

include 'student_con.php' ;

if(isset($_POST['submit']))
{

   $name = mysqli_real_escape_string($con,$_POST['name']);
   $college = mysqli_real_escape_string($con,$_POST['college']);
   $id = mysqli_real_escape_string($con,$_POST['id']);
   $email = mysqli_real_escape_string($con,$_POST['email']);
   $password = mysqli_real_escape_string($con,$_POST['password']);

   $emailquery = "select * from teacher_credencial where email='$email'";
   $query = mysqli_query($con,$emailquery);

   $emailcount = mysqli_num_rows($query);

   if($emailcount>0)
   {
    ?>

    <script>
    alert("Email Already Exists");
    location.href = 'teacher_sign.html';
    </script>

    <?php
   }
   else
   {
    $insertquery="INSERT INTO teacher_credencial(name, college, id, email, password) VALUES ('$name','$college','$id','$email','$password')";

    $iquery = mysqli_query($con , $insertquery);

    if($iquery)
    {
        ?>

        <script>
        alert("Sign Up successfully");
        location.href = 'teacher_portal.html';
        </script>
    
        <?php
    }
    else
    {
        ?>

        <script>
        alert("Connection Lost");
        </script>
    
        <?php
    }
   }


}


?>
