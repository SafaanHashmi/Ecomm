<?php 
   require('top.php'); 
   if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0)
   {
?>
	<script>
		window.location.href='index.php';
	</script>
<?php
   }
   
   
   $cart_total=0;
	foreach($_SESSION['cart'] as $key=>$val)
	{		
		$productArr=get_product($con,'','',$key);
		$pmrp=$productArr[0]['mrp'];
		$pprice=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($pmrp*$qty);
    }
   
   if(isset($_POST['submit']))
   {
	   $address=get_safe_value($con,$_POST['address']);
	   $city=get_safe_value($con,$_POST['city']);
	   $pincode=get_safe_value($con,$_POST['pincode']);
	   $state=get_safe_value($con,$_POST['state']);
	   $country=get_safe_value($con,$_POST['country']);
	   $payment_type=get_safe_value($con,$_POST['payment_type']);
	   $user_id=$_SESSION['USER_ID'];								//from login_submit.php
	   $total_price=$cart_total;
	   $payment_status='pending';
	   if($payment_type=='COD'){
		$payment_status='success';
	   }
	   $order_status='pending';
	   $added_on=date('Y-m-d h:i:s');

		mysqli_query($con,"insert into `order`(user_id,address,city,pincode,state,country,payment_type,total_price,payment_status,order_status,added_on)
		values('$user_id','$address','$city','$pincode','$state','$country','$payment_type','$total_price','$payment_status','$order_status','$added_on')");
		
		$order_id=mysqli_insert_id($con);
		
		foreach($_SESSION['cart'] as $key=>$val)
		{		
			$productArr=get_product($con,'','',$key);
			$pmrp=$productArr[0]['mrp'];
			$pprice=$productArr[0]['price'];
			$qty=$val['qty'];
			
			mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price)
			values('$order_id','$key','$qty','$pmrp')");		
		
		}
		unset($_SESSION['cart']);
		$_SESSION['ty']='Thank you';
?>
		<script>
		window.location.href='thank_you.php';
		</script>
<?php
		
   }
?>


<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/pro.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    
								<?php 
									$accordion_class='accordion__title';
									if(!isset($_SESSION['USER_LOGIN']))
									{
										$accordion_class='accordion__hide';
								?>	
									<div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" action="#" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
																<span class="field_error" id="login_email_error"></span>
															</div>
															
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
																<span class="field_error" id="login_password_error"></span>
															</div>
															
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                            </div>
															<div class="form-output login_msg">
																<p class="form-messege field_error"></p>
															</div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" action="#" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
																<span class="field_error" id="name_error"></span>
															</div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
																<span class="field_error" id="name_error"></span>
															</div>
															<div class="single-input">
                                                                <label for="user-email">Mobile</label>
																<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
																<span class="field_error" id="name_error"></span>
															</div>
															<div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
																<span class="field_error" id="name_error"></span>
															</div>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <br><p style="color:red;color: red; padding: 8px; background: black; text-align: center;">-*-*-*-PLEASE LOGIN OR REGISTER FIRST TO PLACE AN ORDER-*-*-*-</p>
									</div>
									
								<?php
									}
								?>	
								
								<form method="post">
								   <div class="<?php echo $accordion_class ?>">
                                        Address Information
                                    </div>
									
										<div class="accordion__body">
											<div class="bilinfo">
												
													<div class="row">
													   
														<div class="col-md-12">
															<div class="single-input">
																<input type="text" name="address" placeholder="Full Address" required>
															</div>
														</div>
														
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="city" placeholder="City" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="pincode" placeholder="Postal code/ zip" required>
															</div>
														</div>
														
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="state" placeholder="State" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="country" placeholder="Country" required>
															</div>
														</div>
														
													</div>
												
											</div>
										</div>
										<div class="<?php echo $accordion_class ?>">
											payment information
										</div>
										<div class="accordion__body">
											<div class="paymentinfo">
												<div class="single-method">
													<i class="zmdi zmdi-long-arrow-right"></i><label class="radio_me">Cash on dilivery</label>
														<input type="radio" name="payment_type" value="COD" required /><br>
													<i class="zmdi zmdi-long-arrow-right"></i><label class="radio_me">PayU</label>
														<input type="radio" name="payment_type" value="payu" required />
												</div>
												<div class="single-method">
													
												</div>
											</div>
										</div>
									 <center><input class="btn btn-success" style="border:2px solid black;color:black;" type="submit" name="submit" value="Proceed to payment"></center>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
						<div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
							<?php 
							$cart_total=0;
							foreach($_SESSION['cart'] as $key=>$val)
							{	
								$productArr=get_product($con,'','',$key);
								$pname=$productArr[0]['name'];
								$pmrp=$productArr[0]['mrp'];
								$pprice=$productArr[0]['price'];
								$pimage=$productArr[0]['image'];
								$qty=$val['qty'];
								$cart_total=$cart_total+($pmrp*$qty);
							?>
                        
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$pimage?>" />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname ?></a>
                                        <span class="price">Price - <?php echo $pmrp ?>Rs x <?php echo $qty ?> = <u><?php echo $pmrp*$qty ?> Rs </u></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
							<?php 
							}
							?>
                            </div>
                   <!--  <div class="order-details__count">
                                <div class="order-details__count__single">
                                    <h5>sub total</h5>
                                    <span class="price">$909.00</span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Tax</h5>
                                    <span class="price">$9.00</span>
                                </div>  
                            </div> -->
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price"><?php echo $cart_total ?> Rs</span>
                            </div>
                        </div>
							
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        


<?php 
   require('footer.php'); 
?>