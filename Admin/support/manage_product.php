<?php
	require('connection.inc.php'); 
	require('functions.inc.php'); 
	require('top.inc.php');
	$ID='';
	$categories_id='';
	$name='';
	$mrp='';
	$price='';
	$qty='';
	$image='';
	$short_desc='';
	$description='';
	$meta_title='';
	$meta_desc='';
	$meta_keyword='';
	$Status='';
	$msg='';	
	$image_required='required';
	
	if(isset($_GET['id']) && $_GET['id']!='')
	{
		$image_required='';
		$ID=get_safe_value($con,$_GET['id']);
		$sql1="select * from product where ID='$ID'";
		$res1=mysqli_query($con,$sql1);	
		$check=mysqli_num_rows($res1);	
		if($check>0)							//This if condition is used so that no one can do any changes to the URL manually
		{
			$row=mysqli_fetch_assoc($res1);
			$categories_id=$row['categories_id']; 		//Now this is shown in the input field in below HTML code 
			$name=$row['name']; 						//Now this is shown in the input field in below HTML code 
			$mrp=$row['mrp']; 							//Now this is shown in the input field in below HTML code 
			$price=$row['price']; 						//Now this is shown in the input field in below HTML code 
			$qty=$row['qty']; 							//Now this is shown in the input field in below HTML code 
			$short_desc=$row['short_desc']; 			//Now this is shown in the input field in below HTML code 
			$description=$row['description']; 			//Now this is shown in the input field in below HTML code 
			$meta_title=$row['meta_title']; 			//Now this is shown in the input field in below HTML code 
			$meta_desc=$row['meta_desc']; 				//Now this is shown in the input field in below HTML code 
			$meta_keyword=$row['meta_keyword']; 		//Now this is shown in the input field in below HTML code 
		}
		else   									// if someone try to manipulate URL it will redirect it to -:		
		{
			header('location:product.php');
			die();
		}
	}
	
	if(isset($_POST['submit']))
	{
		$categories_id=get_safe_value($con,$_POST['categories_id']);
		$name=get_safe_value($con,$_POST['name']);
		$mrp=get_safe_value($con,$_POST['mrp']);
		$price=get_safe_value($con,$_POST['price']);
		$qty=get_safe_value($con,$_POST['qty']);
		$short_desc=get_safe_value($con,$_POST['short_desc']);
		$description=get_safe_value($con,$_POST['description']);
		$meta_title=get_safe_value($con,$_POST['meta_title']);
		$meta_desc=get_safe_value($con,$_POST['meta_desc']);
		$meta_keyword=get_safe_value($con,$_POST['meta_keyword']);

		
		//THIS PART WILL HELP TO PREVENT US FROM INSERTING TWO CATEGORIES WITH SAME NAME 
		$sql2="select * from product where name='$name'";
		$res2=mysqli_query($con,$sql2);
		$check2=mysqli_num_rows($res2);
		if($check2>0)
		{
			if(isset($_GET['id']) && $_GET['id']!='')		
			{
				$getdata=mysqli_fetch_assoc($res2);
				if($ID==$getdata['ID'])
				{
					
				}
				else
				{
					$msg="This Category name is alredy used";
				}
			}
			else
			{
				$msg="This Category name is alredy used";
			}
		}
		
	/*	if($_FILES['image']['type']!='image/png' && $_FILES['image']['typle']='img/jpg' && $_FILES['image']['typle']='img/jpeg' )
		{
			$msg="Please select PNG,JPG or JPEG image format";
		} */
		
		
		if($msg=='')
		{	
			if(isset($_GET['id']) && $_GET['id']!='')		//FOR EDIT
			{
				if($_FILES['image']['name']!='')
				{
					$image=$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
					$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty'
					,short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword'
					,image='$image' where ID='$ID'";
				}
				else
				{
					$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty'
					,short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword'
					where ID='$ID'";
				}
				mysqli_query($con,$update_sql);
			}
			else											//FOR ADD NEW
			{	
				$image=$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
				mysqli_query($con,"insert into product(`categories_id`,`name`,`mrp`,`price`,`qty`,`short_desc`,`description`,`meta_title`,`meta_desc`,`meta_keyword`,`Status`,`image`) 
				values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");	
			}
			header('location:product.php'); 
			die();
		
		}	
	}  		
	
	
?>

    <div class="content pb-0">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Product Form</strong><small> </small></div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							
							   <div class="form-group">
									<label for="company" class=" form-control-label">Category</label>
									<select class="form-control" name="categories_id"> 
										<option> Select Category </option>
										<?php
											$res0=mysqli_query($con,"select ID,Categories from category order by Categories asc");
											while($rowx=mysqli_fetch_assoc($res0))
											{
											if($rowx['ID']==$categories_id)
												{	
													echo "<option selected value=".$rowx['ID'].">" .$rowx['Categories']. "</option>";
												}
												else
												{	
													echo "<option value=".$rowx['ID'].">" .$rowx['Categories']. "</option>";
												}
											}
										?>
									</select>
								</div>	
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter your Product name" class="form-control" required value="<?php echo $name; ?>">
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Product Mrp</label>
									<input type="text" name="mrp" placeholder="Enter your Product MRP" class="form-control" required value="<?php echo $mrp; ?>">
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Product Price</label>
									<input type="text" name="price" placeholder="Enter your Product price" class="form-control" required value="<?php echo $price; ?>">
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Product Qty</label>
									<input type="text" name="qty" placeholder="Enter your Product qty" class="form-control" required value="<?php echo $qty; ?>">
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Product Image</label>
									<input type="file" name="image" class="form-control"<?php echo $image_required; ?>>
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter Short Description" class="form-control"><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter Description" class="form-control" required><?php echo $description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Meta Title</label>
									<textarea name="meta_title" placeholder="Enter Meta Title" class="form-control"><?php echo $meta_title?></textarea>
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Meta Description</label>
									<textarea name="meta_desc" placeholder="Enter Meta Description" class="form-control"><?php echo $meta_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="company" class=" form-control-label">Meta Keyword</label>
									<textarea name="meta_keyword" placeholder="Enter Meta Keyword" class="form-control" required><?php echo $meta_keyword?></textarea>
								</div>
								
								<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block"> 
								<span id="payment-button-amount">Submit</span>
								</button>
								<div style="color:red;margin-top:15px;"> <?php echo $msg ?> </div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
	</div>




<?php 
	require('footer.inc.php');
?> 