<?php

session_start();

error_reporting(0);
 include "connection.php";

 $message = "";
 $userlevel = "";

 
    if (isset($_SESSION["uid"])) {
      header("Location: admin.php");
    }



    if (isset($_POST["btnLogin"])) 
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, ($_POST['password']));
        $check_user= mysqli_query($conn, "SELECT * FROM user_table WHERE username='$username' AND password='$password'");
          
        if (mysqli_num_rows($check_user) > 0) {
          $row = mysqli_fetch_assoc($check_user);
          
          $_SESSION["uid"] = $row['uid'];
          $_SESSION["userlevel"] = $row['userlevel'];
          $_SESSION["photo"] = $row['photo'];
          $_SESSION["first_name"] = $row['first_name'];
          $_SESSION["last_name"] = $row['last_name'];
        
            header("Location: admin.php");
        

         
        } else {
         
          echo "<script>alert('Login details is incorrect. Please try again.');</script>";
        }
    }


    if (isset($_POST["btnLogin"])) {

      setcookie("username",$_POST['username'],time()+time() + 60*60*24*30); 
      setcookie("password",$_POST['password'],time() + 60*60*24*30);
      header("Location: admin.php");
    }



?>