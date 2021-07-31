
<?php
include('config.php');

if (isset($_GET['id']))
{

$result = mysqli_query($db,"DELETE FROM Products WHERE productId=".$_GET['id']);
if($result===true)
	
header("Location:Ourstock.php");
}

?>