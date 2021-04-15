<?php
	require('connection.inc.php'); 
	require('functions.inc.php'); 
	require('top.inc.php');
	$category1='';
	$msg='';
	
	if(isset($_GET['id']) && $_GET['id']!='')
	{
		$ID=get_safe_value($con,$_GET['id']);
		$sql1="select * from category where ID='$ID'";
		$res1=mysqli_query($con,$sql1);	
		$check=mysqli_num_rows($res1);	
		if($check>0)							//This if condition is used su that no one can do any changes to the URL manually
		{
			$row=mysqli_fetch_assoc($res1);
			$category1=$row['Categories']; 		//Now this is shown in the input field in below HTML code 
		}
		else   									// if someone try to manipulate URL it will redirect it to -:		
		{
			header('location:categories.php');
			die();
		}
	}
	
	if(isset($_POST['submit']))
	{
		$category=get_safe_value($con,$_POST['categories']);
		
		//THIS PART WILL HELP TO PREVENT US FROM INSERTING TWO CATEGORIES WITH SAME NAME 
		$sql2="select * from category where Categories='$category'";
		$res2=mysqli_query($con,$sql2);
		$check2=mysqli_num_rows($res2);
		if($check2>0)
		{
			$msg="This Category name is alredy used";
		}
		else
		{
			if(isset($_GET['id']) && $_GET['id']!='')		//FOR EDIT
			{
				$sql="Update category set Categories='$category' where ID='$ID'";
				$res=mysqli_query($con,$sql);
			}
			
			else											//FOR ADD NEW
			{	
				$sql="Insert into category(Categories,Status) value('$category','1')";
				$res=mysqli_query($con,$sql);	
			}
			header('location:categories.php');
			die();
		}
	}
	
	
?>

    <div class="content pb-0">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Category Form</strong><small> </small></div>
						<form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="company" class=" form-control-label">Categories</label>
									<input type="text" name="categories" placeholder="Enter your company name" class="form-control" required value="<?php echo $category1; ?>">
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