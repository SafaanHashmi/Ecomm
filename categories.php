<?php 
   require('top.php'); 
   $cat_id=$_GET['id'];
   if($cat_id>0)
   {
		$get_product=get_product($con,'',$cat_id);
   }
   else{
	header('location:index.php');
   }
?>

<div class="body__overlay"></div>
       
        <!-- Start Bradcaump area -->
	<?php
		if($cat_id==103)
		{
          echo "<div class='ht__bradcaump__area' style='background: rgba(0, 0, 0, 0) url(images/bg/hm.jpg) no-repeat scroll center center / cover ;'>";
		}
		else
		{
		  echo "<div class='ht__bradcaump__area' style='background: rgba(0, 0, 0, 0) url(images/bg/oth.jpg) no-repeat scroll center center / cover ;'>";
		}
	?>	
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
								  <?php 
										$trials=$_GET['id'];
										$sqltr=mysqli_query($con,"select * from category where ID = $trials");
										$rowtr=mysqli_fetch_assoc($sqltr);
								   ?>
                                  <a class="breadcrumb-item" href="#"><span class="brd-separetor"> <?php echo $rowtr['Categories']; ?> </span></a>
								 
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
				<?php
				 if(count($get_product)>0)
				 {
				?>
				   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select">
                                        <option>Default softing</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by newness</option>
                                    </select>
                                </div>
                                
                                <!-- Start List And Grid View -->
                                <ul class="view__mode" role="tablist">
                                    <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                                    <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                                </ul>
                                <!-- End List And Grid View -->
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        <!-- Start Single Product -->
											<?php
												foreach($get_product as $list)
												{
											?>
											<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
												<div class="category">
													<div class="ht__cat__thumb">
														<a href="product.php?id=<?php echo $list['ID'] ?>">
															<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
														</a>
													</div>
													
													<div class="fr__product__inner">
														<h4><a href="product.php?id=<?php echo $list['ID'] ?>"><?php echo $list['name']?></a></h4>
														 <ul class="fr__pro__prize">
															<li class="old__prize">Market Price</li>
															<li>Our Price</li>
														</ul>
														<ul class="fr__pro__prize">
															<li class="old__prize"><?php echo $list['price']?>Rs &nbsp &nbsp</li>
															<li><?php echo $list['mrp']?> Rs</li>
														</ul>
													</div>
												</div>
											</div>
											
											<?php
												}
											?>
                                        <!-- End Single Product -->
				<?php 
				 }
				 else
				 {
					echo "<center><h2> DATA NOT FOUND </h2></center>";
				 }
				?>						
                                    </div>
                                    <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                        <div class="col-xs-12">
                                            <div class="ht__list__wrap">
                                                <!-- Start List Product -->
                                                <div class="ht__list__product">
                                                    <div class="ht__list__thumb">
                                                        <a href="product.php?id=<?php echo $list['ID'] ?>"><img src="images/product-2/pro-1/1.jpg" alt="product images"></a>
                                                    </div>
                                                    <div class="htc__list__details">
                                                        <h2><a href="product.php?id=<?php echo $list['ID'] ?>">Product Title Here </a></h2>
                                                        <ul  class="pro__prize">
                                                            <li class="old__prize">$82.5</li>
                                                            <li>$75.2</li>
                                                        </ul>
                                                        <ul class="rating">
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li class="old"><i class="icon-star icons"></i></li>
                                                            <li class="old"><i class="icon-star icons"></i></li>
                                                        </ul>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisLorem ipsum dolor sit amet, consec adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqul Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        <div class="fr__list__btn">
                                                            <a class="fr__btn" href="cart.html">Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End List Product -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product View -->
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
		
		

<?php 
   require('footer.php'); 
?>