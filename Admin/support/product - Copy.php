<?php 
	require('connection.inc.php'); 
	require('functions.inc.php');
	require('top.inc.php');
	if(!isset($_SESSION['ADMIN_NAME']))
	{
		header('location:login.php');
	}
	
	if(isset($_GET['type']) && $_GET['type']!='')
	{
		$Type=get_safe_value($con,$_GET['type']);
		if($Type=='status')
		{
			$ID=get_safe_value($con,$_GET['id']);
			$operation=get_safe_value($con,$_GET['operation']);
			if($operation=='active')
			{
				$status='0';
			}
			else
			{
				$status='1';
			}
			$update_status="update product set status='$status' where ID='$ID'";
			mysqli_query($con,$update_status);
		}	
			
		if($Type=='delete')
		{
			$ID=get_safe_value($con,$_GET['id']);
			$delete_sql="delete from product where id='$ID'";
			mysqli_query($con,$delete_sql);
		}			
	}
	
	
	
	$sql="SELECT product.*,Category.Categories from product,Category where product.categories_id=Category.ID ORDER BY product.id desc";
	$res=mysqli_query($con,$sql);
?>    

	<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h2 >PRODUCTS</h2>	<br>
                           <h4 style="float:right"><a href="manage_product.php"><u>Add New Product</u></a></h4>	
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Name</th>
									   <th>Image</th>
									   <th>MRP</th>							   
									   <th>Price</th>							   
									   <th>Qty &nbsp&nbsp&nbsp</th>							   
                                    </tr>
                                 </thead>
                                 <tbody>
									<?php 
										$i=1;
										while($row=mysqli_fetch_assoc($res))
										{ 									
									?>
                                    <tr>
										<td class="serial"><?php echo $i ?></td>
										<td><?php echo $row['ID'] ?></td>
										<td><?php echo $row['Categories'] ?></td>
										<td><?php echo $row['name'] ?></td>
										<td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
										<td><?php echo $row['mrp'] ?></td>
										<td><?php echo $row['price'] ?></td>
										<td><?php echo $row['qty'] ?></td>
										<td><?php  
												if($row['Status']==1)
												{
													echo"<a href='?type=status&operation=active&id=".$row['ID']."'> <Font Color='green'> ACTIVE &nbsp&nbsp</a>";
												}
												else
												{
													echo"<a href='?type=status&operation=deactive&id=".$row['ID']."'><Font Color='orange'> DEACTIVE &nbsp&nbsp</a>";
												}	
											?>
										</td>		
										<td><?php echo"<a href='manage_product.php?id=".$row['ID']."'><Font Color='blue'> EDIT </a>"; ?></td>
										<td><?php echo"<a href='?type=delete&operation=active&id=".$row['ID']."'><Font Color='red'> DELETE &nbsp&nbsp</a>"; ?></td>
										
										
                                    <?php $i=$i+1; }?>	
									</tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		</div>
		
<?php 
	require('footer.inc.php');
?> 