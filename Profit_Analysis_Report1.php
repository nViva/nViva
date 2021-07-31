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
	<link rel="stylesheet" type="text/css" href="css/css/style3.css">
  <link rel="stylesheet" type="text/css" href="newcss.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>
<header>
  <div class="logo"><img src="images/logo.jfif" ><p style="font-size: 16px;">NPC Production Inventory System</p></div>
  <nav>
    <ul>
      <li><a href="index.php" >Home</a></li>
      <li><a href="Ourstock.php" >Our Stock</a></li>
      <li><a href="Purchases.php">Purchases</a></li>
      <li><a href="Sales.php">Sales</a></li>
      <li><a href="Damages.php" >Damages</a></li>
      <li>
  <div class="subnav">
    <button class="subnavbtn" class="active">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="Purchases_Report1.php">Purchases</a>
      <a href="Sales_Report1.php">Sales</a>
      <a href="Damages_Report1.php">Damages</a>
      <a href="Profit_Analysis_Report1.php" class="active">Profit Analysis</a>
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
<div class="contents">

<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="Profit_Analysis_Report.php" method="post">
    <h1>Select Dates</h1>
    From<input type="date" id="monthly" name="from_date" value="<?php echo date('Y-m-d');?>"> To <input type="date" id="monthly" name="to_date" value="<?php echo date('Y-m-d');?>">
    
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="reporting">
    </div>
  </form>
</div>
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
  
</body>
</html>