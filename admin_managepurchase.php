<?php include 'adminheader.php';
extract($_GET);


if (isset($_POST['purchase'])) {
	extract($_POST);



$qr="SELECT * FROM `tbl_purchase_child` INNER JOIN `tbl_purchase_master` USING (`pur_master_id`)  WHERE vendor_id='$vendor' AND item_id='$item' AND cost_price='$cost'";
$res=select($qr);
if (sizeof($res)>0) {
$q4="update tbl_purchase_child set  quantity=quantity+'$quantity' where cost_price='$cost'";
update($q4);
   alert('Sucessfully');
   return redirect('admin_managepurchase.php');
}else{
    
	 	
	echo$q1="insert into tbl_purchase_master values(null,'$cid','$vendor','0',curdate()) ";
   $id=insert($q1);
   echo$q1="insert into tbl_purchase_child values(null,'$id','$item','$cost','$quantity') ";
   insert($q1);
   $q3="update tbl_item set stock=stock+'$quantity' where item_id='$item'";
   update($q3);
   alert('Sucessfully');
   return redirect('admin_managepurchase.php');
 }
	

}


 ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height: 700px">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
<center>
<h1>Manage Purchase</h1>
<form method="post" >
	<table class="table" style="width:500px;color: white">
		<tr>
			<th>Vendor</th>
			<td><select name="vendor" class="form-control">
				<option>Select</option>
				<?php 

				$q="select * from tbl_vendor";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['vendor_id'] ?>"><?php echo $row['vendor_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
		<tr>
			<th>Product</th>
			<td><select name="item" class="form-control">
				<option>Select</option>
				<?php 

				$q="select * from tbl_item";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['item_id'] ?>"><?php echo $row['item_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
	
		<tr>
			<th>Cost Price</th>
			<td><input type="number" required="" class="form-control" name="cost"></td>
		</tr>
		
		
		<tr>
			<th>Quantity</th>
			<td><input type="number" required="" class="form-control" name="quantity"></td>
		</tr>
		

		<td align="center" colspan="2"><input type="submit" name="purchase" value="OK" class="btn-get-started"></td>
	</table>
</form>
</center>
</div>
</section><!-- End Hero -->
<center>
	<h1>View Purchase Details</h1>
	<form>
		<table class="table" style="width: 500px">
			<tr>
				<th>Sino</th>
				<th>Vendor</th>
				<th>Product </th>
				<th>Cost Price</th>
				<th>Quantity</th>
				<th>Date</th>
				
				


				
			</tr>
			<?php 

     $q="select * from tbl_purchase_child inner join tbl_purchase_master using (pur_master_id) inner join tbl_vendor using (vendor_id) inner join tbl_item using (item_id)";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['vendor_name'] ?></td>
    		<td><?php echo $row['item_name'] ?></td>
    		
    		<td><?php echo $row['cost_price'] ?></td>
    		<td><?php echo $row['quantity'] ?></td>
    		
    		<td><?php echo $row['date'] ?></td>
    		
    		

    	
    		
    		<!-- <td><a href="?did=<?php echo $row['member_id'] ?>">delete</a></td>
    		<td><a href="?uid=<?php echo $row['member_id'] ?>">update</a></td> -->
    	</tr>
    <?php }




			 ?>
		</table>
	</form>
</center>
<?php include 'footer.php' ?>