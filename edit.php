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

include('config.php');

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$name=mysqli_real_escape_string($db, $_POST['product_name']);
$price=mysqli_real_escape_string($db, $_POST['price']);
$selling_price=mysqli_real_escape_string($db, $_POST['selling_price']);
$quant=mysqli_real_escape_string($db, $_POST['quantity']);

mysqli_query($db,"UPDATE Products SET productName='$name', purchasingPrice='$price',sellingPrice='$selling_price' WHERE productId='$id'");

header("Location:Ourstock.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM Products WHERE productId=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['productId'];
$name = $row['productName'];
$price = $row['purchasingPrice'];
$selling_price = $row['sellingPrice'];
$quant=$row['balance'];
}
else
{
echo "No results!";
}
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Edit Item</title>
</head>
<body>



<form action="" method="post" action="edit.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<table border="0">
<tr>
<th colspan="2" bgcolor="skyblue"><b>Edit Records </b></th>
</tr>
<tr  bgcolor="darkgrey">
<td width="179" ><b>Item Name<font color="red"><em>*</em></font></b></td>
<td><label>
<input type="text" name="product_name" value="<?php echo $name; ?>"  />
</label></td>
</tr>

<tr  bgcolor="darkgrey">
<td width="179"><b>Purchasing Price<font color="red"><em>*</em></font></b></td>
<td><label>
<input type="text" name="price" value="<?php echo $price ?>" />
</label></td>
</tr>

<tr  bgcolor="darkgrey">
<td width="179"><b>Quantity<font color="red"><em>*</em></font></b></td>
<td><label>
<?php echo $quant;?>
</label></td>
</tr>
<tr  bgcolor="darkgrey">
<td width="179"><b>Selling Price<font color="red"><em>*</em></font></b></td>
<td><label>
<input type="text" name="selling_price" value="<?php echo $selling_price ?>" />
</label></td>
</tr>
<tr align="Right"  bgcolor="darkgrey">
<td colspan="2"><label>
<input type="submit" name="submit" value="Save Changes">&nbsp; <button><a href="Ourstock.php" style="text-decoration: none;">Cancel</a></button> 
</label></td>
</tr>
</table>
</form>
</body>
</html>
