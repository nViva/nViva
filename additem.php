<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php


// initializing variables
$item_name = "";
$item_price    = "";
$true=0;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'NPC');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  $item_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $item_price=mysqli_real_escape_string($db, $_POST['price']);
  $quant=0;
  $selling_price=mysqli_real_escape_string($db, $_POST['selling_price']);

   $result = mysqli_query($db, "SELECT * FROM Products");
while($row = mysqli_fetch_array($result)) {
if($row["productName"]===$item_name)
  $true=1;
}
if($true!=1){
    $query = "INSERT INTO Products (productName,purchasingPrice,sellingPrice,balance) 
  			  VALUES('$item_name','$item_price','$selling_price','$quant')";
      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";
				
    }
    else{
        echo"<script>alert('Something wrong!!!');</script>";
    }
  }
  else{
        echo"<script>alert('This product already exists in Stock!!!');</script>";
    }
  	header('location: Ourstock.php');
}
?>