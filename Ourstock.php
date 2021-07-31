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
	<link rel="stylesheet" type="text/css" href="css/css/style.css">
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
			<li><a href="Ourstock.php" class="active">Our Stock</a></li>
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
 <li><form method="post" action="Ourstock_Search.php">
      <input type="text" placeholder="Search.." name="search" style="margin-top: 10px;" class="search">
      
    </form>
  </li>
		</ul>
	</nav>
	<div class="menu-toggle"><i class="fa fa-bars"></i></i></div>
</header>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Our Products</h4>
                
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Selling Price</th>
                           <th scope="col">Action</th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               $conn = new mysqli("localhost","root","","NPC");
               //mysql_query("insert into product VALUES(,'product_name','price','quant')");

               $sql = "SELECT * FROM Products";
               $result = $conn->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><center><?php echo $row["purchasingPrice"]  ?></center></th>
                      <th><center><?php if($row["balance"]=='0'){ echo"<p style='color:red'>" .$row["balance"]."</p>";} else{echo $row["balance"];}  ?></th>
                      <th><center><?php echo $row["sellingPrice"]  ?></center></th>
            
            <th><center> <a href="up"Edit></a><a href="edit.php?id=<?php echo $row["productId"] ?>"><font color="white"> Edit</font></a> <a href="up"Edit></a><a href="delete.php?id=<?php echo $row["productId"] ?>"><font color="white"> Delete</font></a></center></th>
                    
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="6" >
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               <a href="Stock_Print.php" ><font color="white"> Print</font></a>
                </th></tr>
                <tr><th>
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               
                </th>
                 <?php
               }

            ?>

                                            </tbody>
                                        </table>
           
                                    </div>
                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="additem.php" method="post">
    <h1>Add New Product</h1>
    <div class="add">
      <div class="col-25">
        <label for="product_name">Product Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="product_name" name="product_name" placeholder="Product name..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="price">Purchasing price</label>
      </div>
      <div class="col-75">
        <input type="text" id="price" name="price" placeholder="Purchasing Price..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="selling_price">Selling price</label>
      </div>
      <div class="col-75">
        <input type="text" id="selling_price" name="selling_price" placeholder="Selling Price..">
      </div>
    </div>
    
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="add">
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