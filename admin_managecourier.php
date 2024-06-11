<?php include 'adminheader.php';
extract($_GET);


if (isset($_POST['courierreg'])) {
	extract($_POST);
	$q1="select * from tbl_login where username='$uname' and password='$pwd'";
 		$res1=select($q1);
 		if (sizeof($res1)>0) {
 			alert('Already exists');
 		}else{
 		
    $q="insert into tbl_login values('$uname','$pwd','Courier','1')";
     insert($q);
  $q1="insert into tbl_courier values(null,'$uname','$cid','$fname','$num','$email','$add') ";
   insert($q1);
   alert('Sucessfully');
   return redirect('admin_managecourier.php');
}
}
if (isset($_GET['iid'])) {
	extract($_GET);

	$q="update tbl_login set status='0' where username='$iid'";
	update($q);

}
if (isset($_GET['aid'])) {
	extract($_GET);

	$q="update tbl_login set status='1' where username='$aid'";
	update($q);
}
 if (isset($_GET['uid'])) {
 	extract($_GET);

 	 $q="select * from tbl_courier where courier_id='$uid'";
 	$res=select($q);

 }

 if (isset($_POST['update'])) {
 	extract($_POST);

 	$q="update tbl_courier set courier_name='$fname' ,courier_phone='$num',courier_mail='$email',c_location='$add' where courier_id='$uid'";
 	update($q);
 	 alert('Sucessfully');
   return redirect('admin_managecourier.php');

 }


 ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height: 700px">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
<center>
<h1>Manage Courier</h1>
<form method="post">
	<?php   if (isset($_GET['uid'])) { ?>
	<table class="table" style="width:500px;color: white">
		<tr>
			<th>Name</th>
			<td><input type="text" required="" class="form-control" value="<?php echo $res[0]['courier_name'] ?>" name="fname"></td>
		</tr>
		
		
		<tr>
			<th>Phone</th>
			<td><input type="text" required="" pattern="[0-9]{10}" class="form-control" value="<?php echo $res[0]['courier_phone'] ?>" name="num"></td>
		</tr>
		<tr>
			<th>E-Mail</th>
			<td><input type="email" required="" class="form-control" value="<?php echo $res[0]['courier_mail'] ?>" name="email"></td>
		</tr>
		<tr>
			<th>Address</th>
			<td><textarea name="add" required="" class="form-control"></textarea></td>
		</tr>
		
		
		<td align="center" colspan="2"><input type="submit" name="update" value="submit" class="btn-get-started"></td>
	</table>
<?php }else{ ?>
	<table class="table" style="width:500px;color: white">
		<tr>
			<th>Name</th>
			<td><input type="text" required="" class="form-control" name="fname"></td>
		</tr>
		
		
		<tr>
			<th>Phone</th>
			<td><input type="text" required="" pattern="[0-9]{10}" class="form-control" name="num"></td>
		</tr>
		<tr>
			<th>E-Mail</th>
			<td><input type="email" required="" class="form-control" name="email"></td>
		</tr>
		<tr>
			<th>Address</th>
			<td><textarea name="add" required="" class="form-control"></textarea></td>
		</tr>
		
		<tr>
			<th>User Name</th>
			<td><input type="email" required="" class="form-control"  name="uname"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" required="" class="form-control" name="pwd"></td>
		</tr>
		<td align="center" colspan="2"><input type="submit" name="courierreg" value="Register Courier" class="btn-get-started"></td>
	</table>
<?php } ?>
</form>
</center>
</div>
</section><!-- End Hero -->
<center>
	<h1>View Couriers</h1>
	<form>
		<table class="table" style="width: 1000px">
			<tr>
				<th>Sino</th>
				<th>Name</th>
				<th>Phone</th>
				<th>E-Mail</th>
				<th>Address</th>	
				
			</tr>
			<?php 

     $q="select * from tbl_courier inner join tbl_login using (username)";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['courier_name'] ?></td>
    		<td><?php echo $row['courier_phone'] ?></td>
    		<td><?php echo $row['courier_mail'] ?></td>
    		<td><?php echo $row['c_location'] ?></td>
    		<?php 
    		if ($row['status']=="1") {
    			?>
    			 <td><a class="btn-get-started" href="?iid=<?php echo $row['username'] ?>"><b>InActive</b></a></td>
            
    	<?php 
    		}elseif ($row['status']=="0") {
    			?>
    			<td><a class="btn-get-started" href="?aid=<?php echo $row['username'] ?>"><b>Active</b></a></td>
    	<?php 
    		}

    		 ?>
    		   <td><a class="btn-get-started" href="?uid=<?php echo $row['courier_id'] ?>"><b>Update</b></a></td>
    		<?php 
    	 }


			 ?>
		</table>
	</form>
</center>
<?php include 'adminfooter.php' ?>