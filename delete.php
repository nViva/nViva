
<?php
include('config.php');

if (isset($_GET['id']))
{

$result = mysqli_query($db,"DELETE FROM Products WHERE productId=".$_GET['id']);
if($result===true)
//if done go to Ourstock	
header("Location:Ourstock.php");
}

?>