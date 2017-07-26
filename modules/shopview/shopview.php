<?php 
heading(); 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:".BASE. '/login');
}
?>
<section>
	<div class="shop_user_wrapper" id="shop_user_wrapper">
		<div class="container">
			<div class="row">
		  		<div class="col-sm-6 col-md-6">
		  			<div class="shop_list_logo_area">
		  				<h4>Funnel Buildr Admin Panel</h4>
		  			</div>
		  		</div>
		  		<div class="col-sm-6 col-md-6">
		  			<div class="shopper_login">
		  				<ul>
		  					<li>
		  						<p><?php echo $_SESSION['username']; ?></p>
		  					</li>
		  					<li>
		  						<a href="<?php echo BASE; ?>/logout">Logout</a>
		  					</li>
		  				</ul>
		  			</div>	
		  		</div>
		  	</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
		  	<div class="col-md-12">
			  	<div class="sshower_wrapper">
			  		<div class="shop_header_list">
			  			<h3>Shops</h3>
			  		</div>
<<<<<<< HEAD
			  		<div class="col-sm-3 col-md-4">
			  			<div class="left_sitebar">
			  				<ul>
				  				<li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Shops</a></li>
				  				<li><a href="<?php echo BASE; ?>/user"><i class="fa fa-angle-double-right" aria-hidden="true"></i> User Panel</a></li>
				  			</ul>
			  			</div>
			  		</div>
			  		<div class="col-sm-9 col-md-8">
				  		<div class="shop_list">
				  			<table class="table">
				  				<thead>
				  					<tr>
					  					<th>Shop</th>
					  					<th style="float: right; padding-right: 70px;">Login</th>
					  				</tr>
				  				</thead>
			  				  	<tbody>
			  				  	<?php 
			  				  	global $mysqli;
								$sql = "SELECT shop,token FROM shops";
								$result = $mysqli->query($sql);
			  				  	$total_row = mysqli_num_rows($result);
			  				  	// $total_row = $result->num_rows;
			  				  	$per_page = 25;
								$current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
								// pagination 
								$start_at =$per_page * ($current_page - 1);
								$start_at1 = 1 + $per_page * ($current_page - 1);
								$total_pages = ceil($total_row / $per_page);
								$total_perpageof= $per_page * $current_page;
								if($total_perpageof > $total_row){
									$total_perpageof = $total_row;
								}

								$sql = "SELECT * FROM shops ORDER BY id DESC LIMIT $start_at ,$per_page ";
								$result = $mysqli->query($sql);
								// var_dump($result);
			  				  	if( $total_row > 0 ) {
	               					while( $row = $result->fetch_array( MYSQLI_ASSOC ) ){   
			  				  	?>
			  				  		<!-- start shop view  -->
									<tr>
										<td> <?php echo $row["shop"];?> </td>
										<td>
											<button type="button" class="btn btn-success"><a class="shopif_shop" target="_blank" href="<?php echo APP_BASE."/admin_login/?shop=".$row["shop"]."&token=".$row["token"];?>">Login as Admin</a></button>
										</td>
									</tr>
									<!-- End shop view  -->
						        <?php 
							    	}
								}
								?>
								</tbody>
								<!--Start Pagination -->
								<div class="pagination">
									<div class="pagination_totalcal">
										<p><?php echo $start_at1 ." - ". $total_perpageof; ?> of <?php echo $total_row; ?></p>
									</div>
									<div class="pagination_icon">
										<?php 
											pagination($current_page ,$total_pages );
										 ?>
									 </div>
								</div>
								<!-- End pagination -->
				  			</table>
				  		</div>
			  		</div>
=======
			  		<style type="text/css">
			  			.left_sitebar{
			  				width: 100%;
			  				height: auto;
			  			}

			  			.left_sitebar ul{
			  				list-style: none;
			  			}

			  			.left_sitebar ul li{
			  				padding-top: 10px;
			  				padding-bottom: 10px;
			  			}

			  			.left_sitebar ul{}
			  			.left_sitebar ul{}
			  		</style>
			  		<div class="sitebar_wrapper">
				  		<div class="col-sm-3 col-md-4">
				  			<div class="left_sitebar">
				  				<h4>Category</h4>
				  				<ul>
					  				<li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Shops</a></li>
					  				<li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> User Panel</a></li>
					  			</ul>
				  			</div>
				  		</div>
				  		<div class="col-sm-9 col-md-8">
					  		<div class="shop_list">
					  			<table class="table">
					  				<thead>
					  					<tr>
						  					<th>Shop</th>
						  					<th>Login</th>
						  				</tr>
					  				</thead>
				  				  	<tbody>
				  				  	<?php 
				  				  	global $mysqli;
									$sql = "SELECT shop,token FROM shops";
									$result = $mysqli->query($sql);
				  				  	$total_row = mysqli_num_rows($result);
				  				  	// $total_row = $result->num_rows;
				  				  	$per_page = 3;
									$current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
									// pagination 
									$start_at = $per_page * ($current_page - 1);
									$start_at1 = 1 + $per_page * ($current_page - 1);
									$total_pages = ceil($total_row / $per_page);
									$total_perpageof= $per_page * $current_page;
									if($total_perpageof > $total_row){
										$total_perpageof = $total_row;
									}

									$sql = "SELECT * FROM shops ORDER BY id DESC LIMIT $start_at ,$per_page ";
									$result = $mysqli->query($sql);
									// var_dump($result);
				  				  	if( $total_row > 0 ) {
		               					while( $row = $result->fetch_array( MYSQLI_ASSOC ) ) {   
				  				  	?>
				  				  		<!-- start shop view  -->
										<tr>
											<td> <?php echo $row["shop"];?> </td>
											<td>
												<button type="button" class="btn btn-success"><a class="shopif_shop" target="_blank" href="<?php echo APP_BASE."/admin_login/?shop=".$row["shop"]."?token=".$row["token"];?>">Login as Admin</a></button>
											</td>
										</tr>
										<!-- End shop view  -->
							        <?php 
								    	}
									}
									?>
									</tbody>
									<!--Start Pagination -->
									<style type="text/css">
										.btn{
											color: #fff;
										}
									</style>
									<div class="pagination">
										<div class="pagination_totalcal">
											<p><?php echo $start_at1 ." - ". $total_perpageof; ?> of <?php echo $total_row; ?></p>
										</div>
										<div class="pagination_icon">
											<?php 
												pagination($current_page ,$total_pages );
											 ?>
										 </div>
									</div>
									<!-- End pagination -->
					  			</table>
					  		</div>
				  		</div>
				  	</div>
>>>>>>> e3461aacae373dcb6d010aba902ca7581da7d8f2
			  	</div>
			</div>
  		</div>
	</div>
</section>
<section>
	<div class="shop_footer_area">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
			  	<div class="shop_footer_wrapper">
			  		<p>&copy; All Rights Reserved by Hektor</p>
			  	</div>
			  </div>
			</div>
		</div>
	</div>
</section>
<<<<<<< HEAD
<?php footing(); ?>
<?php 
	function pagination( $current_page ,$total_pages) {
		$next_page = $current_page +1 ;
		$previous_page = $current_page -1 ;

		if ($total_pages == 1 ) {
			echo '<a class="pagi_prev disable" href="">&laquo;</a>';
			echo '<a class="pagi_next disable" href="">&raquo;</a>';
		}

		else if ($current_page >= 1  && $current_page !=  $total_pages) {
			if($current_page==1){
				echo '<a class="pagi_prev disable" href="">&laquo;</a>';
				echo '<a class="pagi_next" href="http://localhost/panel/shopview/?page='.$next_page.'">&raquo;</a>';
			}
			else{
				echo '<a class="pagi_prev" href="http://localhost/panel/shopview/?page='.$previous_page.'">&laquo;</a>';	
				echo '<a class="pagi_next" href="http://localhost/panel/shopview/?page='.$next_page.'">&raquo;</a>';
			}
=======
<style type="text/css">

</style>
<?php footing(); ?>

<?php 
	function pagination( $current_page ,$total_pages) {

		$next_page = $current_page +1 ;
		$previous_page = $current_page -1 ;

		if ($current_page == 1 ) {

			echo '<a class="pagi_prev disable" href="">&laquo;</a>';
			echo '<a class="pagi_next" href="http://localhost/panel/shopview/?page='.$next_page.'">&raquo;</a>';
		}

		else if ($current_page > 1  && $current_page !=  $total_pages) {

			echo '<a class="pagi_prev" href="http://localhost/panel/shopview/?page='.$previous_page.'">&laquo;</a>';
			echo '<a class="pagi_next" href="http://localhost/panel/shopview/?page='.$next_page.'">&raquo;</a>';
>>>>>>> e3461aacae373dcb6d010aba902ca7581da7d8f2
		}

		else if ( $current_page ==  $total_pages) {

			echo '<a class="pagi_prev" href="http://localhost/panel/shopview/?page='.$previous_page.'">&laquo;</a>';
			echo '<a class="pagi_next disable" href="">&raquo;</a>';
		}
	}

?>



        