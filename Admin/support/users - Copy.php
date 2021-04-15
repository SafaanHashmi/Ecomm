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
		
		if($Type=='delete')
		{
			$ID=get_safe_value($con,$_GET['id']);
			$delete_sql="delete from users where id='$ID'";
			mysqli_query($con,$delete_sql);
		}			
	}
	
	
	
	$sql="SELECT * FROM users ORDER BY ID desc";
	$res=mysqli_query($con,$sql);
?>    

	<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h2 >USERS</h2>	<br>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
								   	   <th class="serial">#</th>
									    <th>ID</th>
							   		    <th>Name</th>
								   	    <th>Email</th>
								   	    <th>Mobile</th>							   
										<th>Date</th>							   
										<th>DELETE</th>							   
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
										<td><?php echo $row['name'] ?></td>
										<td><?php echo $row['email'] ?></td>
										<td><?php echo $row['mobile'] ?></td>							
										<td><?php echo $row['added_on'] ?></td>
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