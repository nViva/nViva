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
               <center> <h4 class="header-title">NPC PRODUCTION REPORT</h4>
                <h4 class="header-title">PROFIT ANALYSIS REPORT OF <?php echo $_SESSION['from'];?> To <?php echo $_SESSION['to']?> AS ON <?php echo"".date("y-m-d");?></h4></center><hr>
                
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
                                                    <th scope="col">PROFIT</th>
                                                     
                                                     

                                                    
                                                </tr><tr><th colspan="10"><br></th></tr>
                                            </thead>
                                            <tbody>
           <?php 
               $conn = new mysqli("localhost","root","","NPC");
          $aa= $_SESSION['from'];
          $bb= $_SESSION['to'];
               

              $sql = "SELECT DISTINCT Products.productName,Sales.quantity AS sold,Products.purchasingPrice,Sales.selling_price,Sales.quantity*Sales.selling_price as sales_value,(Sales.quantity*Products.purchasingPrice) AS Purchases_value,Damages.quantity AS damaged,Damages.damagesDate,(Damages.quantity*Damages.selling_price) AS damages_value,(Sales.quantity*Sales.selling_price)-((Sales.quantity*Products.purchasingPrice)+(Damages.quantity*Damages.selling_price)) AS Profit FROM Products JOIN Sales ON Products.productId=Sales.productId JOIN Damages ON Products.productId=Damages.productId  WHERE (Sales.salesDate BETWEEN '$aa' AND '$bb' AND Damages.damagesDate BETWEEN '$aa' AND '$bb') ";
               
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
                  
                   
                   <tr class="database-data">
                    <th><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["purchasingPrice"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["sold"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["Purchases_value"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["selling_price"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["sales_value"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["damaged"]  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["damages_value"]  ."</p>"?></th>
                      <th><?php if ($aaa<0) { ?>
                        
                       <font color="red"> <?php echo $aaa;} else{?></font> <?php  echo"<font color='black'>" .$aaa."</font>"; }?></th> 
                    </tr>
            <?php
            
                 $sum=$sum+$aaa; 
                 $sum2=$sum2+$row["sales_value"];
                 $sum3=$sum3+$row["damages_value"];
                 $sum4=$sum4+$row["Purchases_value"];
                 }
                 }
                 ?>
               


                  <?php  
$sql3 = "SELECT DISTINCT Products.productName,Products.purchasingPrice,(Sales.quantity*Products.purchasingPrice) AS Purchases_Value,Sales.quantity AS Sold,Sales.salesDate,Sales.selling_price,(Sales.quantity*Sales.selling_price) AS Sales_Value,Sales.productId,(Sales.quantity*Sales.selling_price)-(Sales.quantity*Products.purchasingPrice) AS profit FROM Products  JOIN Sales ON Products.productId=Sales.productId JOIN Damages WHERE Sales.productId NOT IN(SELECT productId FROM Damages WHERE Damages.damagesDate BETWEEN '".$aa."' AND '".$bb."') AND Sales.salesDate BETWEEN '".$aa."' AND '".$bb."'";
               
               $result3 = $conn->query($sql3);
                    $count=$count;
                    $sum=$sum;
                  $sum2=$sum2;
                  $sum3=$sum3;
                  $sum4=$sum4;
               if ($result3 -> num_rows >  0) {
                  
                 while ($row3 = $result3->fetch_assoc()) 
                 {


                     

                  $count=$count+1;?>
                 <tr class="database-data">   <th><?php echo "<p style='text-align:center;color:black;'>".$count."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["purchasingPrice"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["Sold"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["Purchases_Value"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["selling_price"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row3["Sales_Value"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php if ($row3["profit"]<0) { ?>
                        
                       <font color="red"> <?php echo $row3["profit"];} else{?></font> <?php echo"<font color='black'>" .$row3["profit"]."</font>"; }?></th>   
                    
                 </tr>
                 <?php 

                 $sum=$sum+$row3["profit"]; 
                 $sum2=$sum2+$row3["Sales_Value"];
                 $sum3=$sum3;
                 $sum4=$sum4+$row3["Purchases_Value"];
}
}
                 ?>



                  <?php  
$sql2 = "SELECT DISTINCT Products.productName,Products.purchasingPrice,(Damages.quantity*Products.purchasingPrice) AS purchases_value,Damages.quantity AS damaged,Damages.damagesDate,Damages.selling_price,(Damages.quantity*Damages.selling_price) AS damages_value,Damages.productId FROM Products  JOIN Damages ON Products.productId=Damages.productId JOIN Sales WHERE Damages.productId NOT IN(SELECT productId FROM Sales WHERE Sales.salesDate BETWEEN '".$aa."' AND '".$bb."') ";
               
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
                 <tr class="database-data">   <th><?php echo "<p style='text-align:center;color:black;'>".$count."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["purchasingPrice"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["purchases_value"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["selling_price"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>0</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["damaged"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row2["damages_value"] ."</p>"?></th>
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
                 <tr style='font-size:24px;'><th>Total</th><th></th><th></th><th></th><th><?php echo $sum4; ?></th><th><th><?php echo $sum2; ?></th></th><th></th><th><?php echo $sum3; ?></th><th><?php echo $sum ?></th></tr>
                
              
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
    Prepared by:<?php  if (isset($_SESSION['first_name']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRODUCTION MANAGER</strong>

</body>
</center>
</html>