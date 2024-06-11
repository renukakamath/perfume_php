<?php include 'adminheader.php';

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



 ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height: 300px">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
         </div>
  </section><!-- End Hero -->
<center>
	<h1>View Customers</h1>
	<form>
		<table class="table" style="width: 500px">
			<tr>
				<th>Sino</th>
			   <th>First Name</th>
				<th>Last Name</th>
				
			     <th>City</th>
				<th>District</th>
                <th>State</th>
				<th>Pincode</th>
                <th>Phone</th>
				<th>Gender</th>
				
			
			

				
			</tr>
			<?php 

     $q="select * from tbl_customer inner join tbl_login using (username) ";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['cust_fname'] ?></td>
    		<td><?php echo $row['cust_lname'] ?></td>
    		
    		<td><?php echo $row['cust_city'] ?></td>
    		<td><?php echo $row['cust_district'] ?></td>
    	
    		<td><?php echo $row['cust_state'] ?></td>
    		<td><?php echo $row['cust_pincode'] ?></td>
            <td><?php echo $row['cust_phone'] ?></td>
    		<td><?php echo $row['cust_gender'] ?></td>

    		<?php if ($row['status']=="1") {
    			?>

            <td><a class="btn-get-started" href="?iid=<?php echo $row['username'] ?>"><b>InActive</b></a></td>
            

    		<?php 
    		}elseif ($row['status']=="0") {
    			?>
    			<td><a class="btn-get-started" href="?aid=<?php echo $row['username'] ?>"><b>Active</b></a></td>
    		<?php 
    		} ?>

    
    	</tr>
    <?php }




			 ?>
		</table>
	</form>
</center>
<?php include 'adminfooter.php' ?>