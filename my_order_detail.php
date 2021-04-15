<?php 
	require('top.php');
	$order_id=get_safe_value($con,$_GET['id']);
?>	

 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">My Order </span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Order ID</span></th>
                                                <th class="product-thumbnail">Order Date</th>
                                                <th class="product-name"><span class="nobr"> Address</span></th>
                                                <th class="product-name"><span class="nobr">Payment Type</span></th>
                                                <th class="product-price"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$uid=$_SESSION['USER_ID'];
											$res=mysqli_query($con,"select * from `order` where user_id ='$uid'");
											while($row=mysqli_fetch_assoc($res))
											{
										?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="#"> <?php echo $row['ID']?></a></td>
                                                <td class="product-name"><?php echo $row['added_on']?></td>
                                                <td class="product-name">
													<?php echo $row['address']?>,
													<?php echo $row['city']?>,
													<?php echo $row['state']?>,
													<?php echo $row['country']?>,
													[<?php echo $row['pincode']?>]
												</td>
                                                <td class="product-name"><?php echo $row['payment_type']?></td>
                                                <td class="product-name"><?php echo $row['payment_status']?></td>
                                                <td class="product-name"><?php echo $row['order_status']?></td>
                                               
                                            </tr>
										<?php
											}
										?>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
<?php 
	require('footer.php')
?>        