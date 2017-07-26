<?php 
heading(); 
session_start();
form_processor();
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
			  			<h3>User Panel</h3>
			  		</div>
			  		<div class="sitebar_wrapper">
				  		<div class="col-sm-3 col-md-4">
				  			<div class="left_sitebar">
				  				<ul>
					  				<li>
					  					<a href="<?php echo BASE; ?>/shopview"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Shops
					  					</a>
					  				</li>
					  				<li>
					  					<a href="<?php echo BASE; ?>/user"><i class="fa fa-angle-double-right" aria-hidden="true"></i> User Panel
					  					</a>
					  				</li>
					  			</ul>
				  			</div>
				  		</div>

				  		<div class="col-sm-9 col-md-8">
					  		<div class="right_sitebar">
					  			 <?php echo get_flash_message()['message']; ?>
					  			<div class="user_form">
					  				<form class="form-inline" action="<?php echo BASE ?>/user/?process=users" method="post">
										<div class="form-group">
											<label>Username: </label>
											<input name="username" type="text" class="form-control" placeholder="Username" required >
										</div>
										<div class="form-group password">
											<label>Password: </label>
											<input name="password" type="password" class="form-control" placeholder="Password" required >
										</div>
										<button type="submit" class="btn btn-default">Submit</button>
									</form>
					  			</div>
					  			<table class="table">
					  				<thead>
					  					<tr>
					  						<th>Sl No.</th>
					  						<th>Username</th>
					  						<th>Password</th>
					  					</tr>
					  				</thead>
				  				  	<tbody>
				  				  		<?php 
				  				  			$string = file_get_contents("files/json/users.json");
	    									$json_array = json_decode($string, true);

				  				  			$count = 1;
				  				  			foreach($json_array as $k=>$v){
				  				  				$count++;
				  				  			}
				  				  			$total_row = $count - 1;
				  				  			$per_page = 3;
											$current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
											// pagination 
											$start_at =$per_page * ($current_page - 1);
											$start_at1 = 1 + $per_page * ($current_page - 1);
											$total_pages = ceil($total_row / $per_page);
											$total_perpageof= $per_page * $current_page;
											if($total_perpageof > $total_row){
												$total_perpageof = $total_row;
											}

				  				  			

				  				  			$i = 1;
				  				  			foreach($json_array as $k=>$v){ 
				  				  				if (($i > $start_at) && ($i <= ($start_at+$per_page))) {
				  				  					
				  				  			?>
				  				  				<tr>
				  				  					<td name='id'><?php echo $i ?></td>
			  				  						<td><?php echo $k ?></td>
			  				  						<td><?php echo $v ?></td>
			  				  						<?php if($_SESSION['username'] == $k):?>
			  				  							<td><a href="" class='btn btn-default disable'>Delete</a>
			  											</td>
		  											<?php else:?>
			  				  						<td><a onClick="return confirm('Are you sure?')" href="<?php echo BASE ?>/user/?process=delete_user&user_id=<?php echo $i ?>" class='btn btn-danger'>Delete</a>
			  										</td>
			  									<?php endif;?>
		  				  						</tr>
		  				  						<?php 
		  				  						}
		  				  						$i++;

				  				  			}
				  				  			
				  				  		?>
				  				  	</tbody>
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
					  			</table>
					  		</div>
				  		</div>
				  	</div>
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

<?php
	footing();
	/*
	*Read Json file from location
	*@return array
	*/
	function get_json(){
	    $string = file_get_contents("files/json/users.json");
	    return json_decode($string, true);
	}

	function set_json($json_array){
		file_put_contents('files/json/users.json', json_encode($json_array));
		set_flash_message("List Updated Successfully",2);
		header("Location:".BASE. '/user');

	}

	function process_users(){
		$json_array = get_json();
	 	$new_user = $_REQUEST['username'];
	    //If user dont exists
	    if(empty($json_array[$new_user])){
	      // New user added into JSON file
	      $json_array[$new_user] = md5($_REQUEST['password']);
	     //Save new user
	      file_put_contents('files/json/users.json', json_encode($json_array));
	      set_flash_message('<h3 style="color:green; text-align:center;">Created successfully</h3>',1);
	      header("Location:".BASE. '/user');
	    }
	    //User already exists
	    else{
	      set_flash_message('<h3 style="color:#f00; text-align:center;">User already exists</h3>',0);
	      header("Location:".BASE. '/user');
	    }
	}

	function process_delete_user () {
		$json_array = get_json();
		$new_array;
		$i = 1;
		foreach ($json_array as $key => $value) {
			if($i != $_REQUEST['user_id']){
				$new_array[$key] = $json_array[$key];
			}
			$i++;
		}
		set_json($new_array);
		header("Location:".BASE. '/user');
	}

	

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
				echo '<a class="pagi_next" href="http://localhost/panel/user/?page='.$next_page.'">&raquo;</a>';
			}
			else{
				echo '<a class="pagi_prev" href="http://localhost/panel/user/?page='.$previous_page.'">&laquo;</a>';	
				echo '<a class="pagi_next" href="http://localhost/panel/user/?page='.$next_page.'">&raquo;</a>';
			}
		}

		else if ( $current_page ==  $total_pages) {

			echo '<a class="pagi_prev" href="http://localhost/panel/user/?page='.$previous_page.'">&laquo;</a>';
			echo '<a class="pagi_next disable" href="">&raquo;</a>';
		}
	}
	
?>