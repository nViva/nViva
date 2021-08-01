<?php 
  session_start(); 

  $usersCount=$_SESSION['productcount'];
?>
<?php
$conn = new mysqli("localhost","root","","NPC");
for($i=0;$i<$usersCount;$i++) {
$purchased=mysqli_query($conn, "UPDATE Products set purchasingPrice='" . $_POST["price"][$i] . "', balance=balance+'" . $_POST["quant"][$i] . "', sellingPrice='" . $_POST["selling_price"][$i] . "' WHERE productId='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0");
$sd=1;
if($sd)
{
 
    $d=$_POST["datee"];
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
$j=mysqli_query($conn,"INSERT INTO Purchases ( productId, quantity, price, purchaseDate) VALUES('" . $_POST["product_id"][$i] . "','" . $_POST["quant"][$i] . "','" . $_POST["price"][$i] . "','".$d."')");
}
}
   
    header("Location:Ourstock.php");
}
?>