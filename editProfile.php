<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: login.php");
  }
?>
<?php
$conn = new mysqli("localhost","root","","NPC");
$password=md5($_POST["password"]);
$purchased=mysqli_query($conn, "UPDATE Users set userName='" . $_POST["userName"] . "', firstName='" . $_POST["firstName"] . "', lastName='" . $_POST["lastName"]. "', email='" . $_POST["email"] . "', mobile='" . $_POST["mobile"] . "', password='" . $password . "' WHERE userID='" . $_POST["user_id"] . "'");

  $_SESSION['newusername']=$_POST["userName"];
  $_SESSION['newpassword']=$_POST["password"];
    header("Location:edit_ProfileMessage.php");

?>