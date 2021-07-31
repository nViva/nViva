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
  $a=$_SESSION['from'];
               $b=$_SESSION['to'];
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>NPC PRODUCTION REPORT</title>
</head>
<center>
<body  onload="window.print()">

            <div>
            
            <div class="main-content-inner">
                <br>
              <h4 class="header-title">NPC PRODUCTION REPORT</h4>
               <h4 class="header-title">PURCHASES REPORT OF <?php echo $a;?> To <?php echo $b;?> AS ON <?php echo"".date("y-m-d");?></h4><hr>
                
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                             <thead class="text-uppercase">
                                               <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Quantity Purchased</th>
                                                    <th scope="col">Unit/Price</th>
                                                    <th scope="col"> Total Price</th>
                                                    <th scope="col">Purchasing Date</th>
                                                     
                                                     

                                                    
                                                </tr><tr><th colspan="6"><br></th></tr>
                                                <tr><hr></tr>
                                            </thead>
                                            
            <?php 
            
               $conn = new mysqli("localhost","root","","NPC");
               //mysql_query("insert into product VALUES(,'product_name','price','quant')");

               $sql = "SELECT Products.productId,Purchases.productId,Products.productName,Purchases.quantity,Purchases.price,Purchases.purchaseDate FROM Products JOIN Purchases ON Products.productId=Purchases.productId WHERE Purchases.purchaseDate BETWEEN '".$a."' AND '".$b."'";
               $result = $conn->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["quantity"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["price"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["quantity"]*$row["price"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["purchaseDate"]  ."</p>"?></th>
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["quantity"]*$row["price"];    
                 }
                 
                 ?>
                 
                 <tr style='font-size:24px;'><th>Total</th><th></th><th></th><th></th><th><?php echo $sum; ?></th></tr>
                
            <?php
                 
                 }
                 

            ?>

                                            
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   
                    </div>
                    <!-- Contextual Classes end -->
                   
        <!-- main content area end -->
      






    </div>
    <br>
    <hr>
    Prepared by:<?php  if (isset($_SESSION['username']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRODUCTION MANAGER</strong>

</body>
</center>
</html>
