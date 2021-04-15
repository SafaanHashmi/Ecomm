<?php 
	require('top.php');
	$User_name=$_SESSION['USER_NAME'];
	if(!isset($_SESSION['ty']))
	{
?>
	<script>
		window.location.href='index.php';
	</script>
<?php	
	}
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
                                  <span class="breadcrumb-item active">Thank You</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <center> <h1><u><?php echo $User_name ?> your order is placed successfully </u></h1> <br>
								<h2> Thank you for shopping </h2> <br>
								
                                <p><a href="ty2.php"><u>Return to home</u></a></p> <br>
								
					   </center>
                    </div>
                </div>
            </div>
        </div>
        
										
<?php require('footer.php')

?>        