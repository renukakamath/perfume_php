<?php include 'connection.php';
 $cid=$_SESSION['cust_id'];
extract($_GET)

 ?>
<script> 
    function printDiv() { 
      var divContents = document.getElementById("div_print").innerHTML; 
      var a = window.open('', '', 'height=500, width=500'); 
      a.document.write(divContents); 
      a.document.close(); 
      a.print(); 
    } 
  </script> 
<body onload="printDiv()">
  <div id="div_print" >
<center>
  
<h1 style="padding-top: 30px;font-size: 60px">Bill</h1>

<!-- <h1>View Sales</h1> -->
<table class="table" style="width: 1000px;color: black;font-style: italic;font-family: monospace;font-size: 22px" border="5">
	 <tr>
        <th>Sino</th>
         <th>Date</th>
        <!-- <th>Total Amount</th> -->
        
           <th>Product</th>
        <th>Quantity</th>
                <th>Amount</th>
        <th>Image</th>
               <!--  <th>Status</th> -->
        
      </tr>
      <?php 

     $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cartmaster` USING (`cart_master_id`)INNER JOIN `tbl_cartchild` USING (cart_master_id) INNER JOIN `tbl_item` USING (item_id) where cust_id='$cid' and status='paid' or status='Delivered'";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
      <tr>
        <td><?php echo $sino++; ?></td>
        <td><?php echo $row['o_date'] ?></td> 
        <!-- <td><?php echo $row['total_amount'] ?></td> -->
      
        <td><?php echo $row['item_name'] ?></td>
        <td><?php echo $row['qty'] ?></td>
            <td><?php echo $row['total_price'] ?></td>
        <td><img src="<?php echo $row['item_image'] ?>" height="100" width="100"></td>
     <?php
       }


		 ?>
	</table>
</center>