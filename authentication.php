<?php
session_start();

// initializing variables
$username = "";
$email    = "";

$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'NPC');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// LOGIN USER
if(isset($_POST['submit']))
{
  
  //mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  
    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) 
    {
      
      $query = "SELECT * FROM Users WHERE userName='$username' AND password ='$password'";
    
    
    
    
    $sql="SELECT firstName,lastName FROM Users WHERE userName='$username' AND password ='$password'";
    $result=mysqli_query($db,$sql);  
    $row=mysqli_fetch_assoc($result);
   
   
   
      $results = mysqli_query($db, $query);
      $res=mysqli_num_rows($results);
      if ($res) 
      {
        $_SESSION['username'] = $username;
        $_SESSION['first_name'] =$row["firstName"];
    
    $_SESSION['last_name'] =$row["lastName"];
        header('location: index.php');
      }
      else 
      {
        array_push($errors, "<b style='color:red'>Wrong username/password combination</b>");
      }
    }

    

   
  }
  
  ?>
  