<?php 

  session_start(); 

  $product_count=$_SESSION['productcount'];
?>
<?php
$conn = new mysqli("localhost","root","","NPC");
	 $d=$_POST["date"];
for($i=0;$i<$product_count;$i++) {
$damaging=mysqli_query($conn, "UPDATE Products set balance=balance-'" . $_POST["quant"][$i] . "' WHERE productId='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0 ");
$sd=1;
if($sd)
{
    
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
$j=mysqli_query($conn,"INSERT INTO Damages ( productId, quantity, selling_price, damagesDate) VALUES('" . $_POST["product_id"][$i] . "','" . $_POST["quant"][$i] . "','" . $_POST["selling_price"][$i] . "','".$d."')");

}
}
}
   
    header("Location:Ourstock.php");

?>