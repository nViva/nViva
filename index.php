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
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>NPC Production Inventory System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="newcss.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


    </style>
</head>
<body>
<header>
	<div class="logo"><img src="images/logo.jfif" >NPC Production Inventory System</div>
	<nav>
		<ul>
			<li><a href="index.php" class="active">Home</a></li>
			<li><a href="Ourstock.php" >Our Stock</a></li>
			<li><a href="Purchases.php">Purchases</a></li>
			<li><a href="Sales.php">Sales</a></li>
			<li><a href="Damages.php">Damages</a></li>
      
      <li>
  <div class="subnav">
    <button class="subnavbtn">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="Purchases_Report1.php">Purchases</a>
      <a href="Sales_Report1.php">Sales</a>
      <a href="Damages_Report1.php">Damages</a>
      <a href="Profit_Analysis_Report1.php">Profit Analysis</a>
    </div>
 </div></li>
			 <li>
  <div class="subnav">
    <button class="subnavbtn">Settings <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="edit_Profile.php">Edit Profile</a>
      <a href="index.php?logout='1'">Logout</a>
    </div>
 </div></li>
 
		</ul>
   </nav>
	<div class="menu-toggle"><i class="fa fa-bars"></i></i></div>
</header>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('.menu-toggle').click(function(){
  			$('nav').toggleClass('active')

  		})
  	})
  	
  </script>
  <img src="images/npc1.jpg" alt="welcome " style="width:100%">
</body>
</html>