
<?php

include 'student_con.php' ;

if(isset($_POST['submit']))
{

   $name = mysqli_real_escape_string($con,$_POST['name']);
   $college = mysqli_real_escape_string($con,$_POST['college']);
   $branch = mysqli_real_escape_string($con,$_POST['branch']);
   $uid = mysqli_real_escape_string($con,$_POST['uid']);
   $email = mysqli_real_escape_string($con,$_POST['email']);
   $password = mysqli_real_escape_string($con,$_POST['password']);

   $emailquery = "select * from student_credencial where email='$email'";
   $query = mysqli_query($con,$emailquery);

   $emailcount = mysqli_num_rows($query);

   if($emailcount>0)
   {
    ?>

    <script>
    alert("Email Already Exists");
    location.href = 'student_sign.html';
    </script>

    <?php
   }
   else
   {
    $insertquery="INSERT INTO student_credencial(name, college, branch, uid, email, password) VALUES ('$name','$college','$branch','$uid','$email','$password')";

    $iquery = mysqli_query($con , $insertquery);

    if($iquery)
    {
        ?>

        <script>
        alert("Sign Up successfully");
        location.href = 'student_portal.html';
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
