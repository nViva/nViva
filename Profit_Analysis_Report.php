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
      <li><a href="Sales.php" >Sales</a></li>
      <li><a href="Damages.php" >Damages</a></li>
      <li>
  <div class="subnav">
    <button class="subnavbtn" class="active">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="Purchases_Report1.php" class="active">Purchases</a>
      <a href="Sales_Report1.php">Sales</a>
      <a href="Damages_Report1.php">Damages</a>
      <a href="Profit_Analysis_Report1.php" >Profit Analysis</a>
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

<div>
            
            <div class="main-content-inner">
                <br>
                
              <h4 class="heading">NPC PRODUCTION REPORT</h4><br>
                <h4 class="heading"> PROFIT ANALYSIS REPORT OF <?php echo $_POST['from_date'];?> To <?php echo $_POST['to_date']?> AS ON <?php echo"".date("y-m-d");?></h4>
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Purchasing Unit/Price</th>
                                                    <th scope="col">Quantity Sold</th>
                                                    <th scope="col">Purchasing Value</th>
                                                    <th scope="col">Selling Unit/Price</th>
                                                    <th scope="col">SALES VALUE</th>
                                                    <th scope="col">Quantity Damaged</th>
                                                    <th scope="col">Damages Value</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">PROFIT</th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               $conn = new mysqli("localhost","root","","NPC");
               if(isset($_POST['reporting']))
               {
                $aa=$_POST["from_date"];
                $bb=$_POST["to_date"];
               $_SESSION['from']=$aa;
               $_SESSION['to']=$bb;
               
              $sql = "SELECT DISTINCT Products.productName,Sales.quantity AS sold,Products.purchasingPrice,Sales.selling_price,Sales.quantity*Sales.selling_price as sales_value,(Sales.quantity*Products.purchasingPrice) AS Purchases_value,Sales.salesDate AS sdate,(Sales.quantity*Sales.selling_price)-(Sales.quantity*Products.purchasingPrice) AS Profit FROM Products JOIN Sales ON Products.productId=Sales.productId  WHERE Sales.salesDate BETWEEN '$aa' AND '$bb' ";
               
               $result = $conn->query($sql);
                    $count=0;
                    $sum=0;
                  $sum2=0;
                  $sum3=0;
                  $sum4=0;
               if ($result -> num_rows >  0) {
                  
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                      
                     $aaa=$row["Profit"];
                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["purchasingPrice"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["sold"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["Purchases_value"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["selling_price"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["sales_value"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["sdate"]  ."</p>"?></th>
                      <th><?php if ($aaa<0) { ?>
                        
                       <font color="red"> <?php echo $aaa;} else{?></font> <?php  echo"<font color='black'>" .$aaa."</font>"; }?></th> 
                    </tr>
            <?php
            
                 $sum=$sum+$aaa; 
                 $sum2=$sum2+$row["sales_value"];
                 $sum3=$sum3;
                 $sum4=$sum4+$row["Purchases_value"];
                 }
                 }
                 ?>
               



                  <?php  
$sql2 = "SELECT DISTINCT Products.productName,Products.purchasingPrice,(Damages.quantity*Products.purchasingPrice) AS purchases_value,Damages.quantity AS damaged,Damages.damagesDate,Damages.selling_price,(Damages.quantity*Damages.selling_price) AS damages_value,Damages.productId,Damages.damagesDate AS ddate FROM Products  JOIN Damages ON Products.productId=Damages.productId WHERE Damages.damagesDate BETWEEN '".$aa."' AND '".$bb."'";
               
               $result2 = $conn->query($sql2);
                    $count=$count;
                    $sum=$sum;
                  $sum2=$sum2;
                  $sum3=$sum3;
                  $sum4=$sum4;
               if ($result2 -> num_rows >  0) {
                  
                 while ($row2 = $result2->fetch_assoc()) 
                 {




                  $count=$count+1;?>
                 <tr class="database-data" style="background-color: #2196f3;">   <th><?php echo "<p style='text-align:center;color:black;'>".$count."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["purchasingPrice"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["purchases_value"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["selling_price"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["damaged"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["damages_value"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["ddate"]  ."</p>"?></th>
                      <th><font color="red"> <?php echo -$row2["damages_value"] ?></font></th>  
                    
                 </tr>
                 <?php 

                 $sum=$sum-$row2["damages_value"]; 
                 $sum2=$sum2;
                 $sum3=$sum3+$row2["damages_value"];
                 $sum4=$sum4+$row2["purchases_value"];
}
}
                 ?>
                 <?php
               
               if($result -> num_rows>0 || $result2 -> num_rows>0){

                ?>
                 <tr style='font-size:24px;;color:black;background-color: #979A99'><th>Total</th><th></th><th></th><th></th><th><?php echo $sum4; ?></th><th><th><?php echo $sum2; ?></th></th><th></th><th><?php echo $sum3; ?></th><th></th><th><?php echo $sum ?></th></tr>
                 <tr><th>
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               <a href="Profit_Report_Print.php" >Print</a>
                </th></tr><?php } ?>
                 <?php
               
               if($result -> num_rows===0 && $result2 -> num_rows===0){

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No Record Found for the selected dates!!!</th></tr>
                <?php
}


            ?>
                 </tbody>
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   

                    </form> 
                    </div>
                    </body>
</html>

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
  <?php 
}
?>