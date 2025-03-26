<?php
include '../user/connect.php';

if (isset($_POST['signIn'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM admin_db  WHERE email='$email' and password='$password'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      session_start();
      $row = $result->fetch_assoc();
      $_SESSION['email'] = $row['email'];
      $_SESSION['a_id'] = $row['admin_id'];
      header("Location: packageShow.php");
      exit();
   } else {
      echo  "<script>alert('Wrong password. Please try again.');window.location.href='adminlog.php';</script>";
   }
}
