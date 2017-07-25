<?php
  session_start();
  form_processor();
	heading();
?>

<div class="wrapper">
  <form class="form-signin" action="<?php echo BASE ?>/login/?process=login" method="post">       
    <h2 class="form-signin-heading" style="text-align: center;">Please login</h2>
    <input type="text" class="form-control" name="username" placeholder="User Name" required="" autofocus="" />
    <input type="password" class="form-control" name="password" placeholder="Password" required=""/> 
    <br> 
    <?php 
    if ($_SESSION['login_step'] == 2) {
      echo "<label style='color: red;'>Username or Password don't match.</label>";
    }
    $_SESSION['login_step'] = 0;
    ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Login</button>  
  </form>
</div>
<?php
  footing();
  function process_login() {
    // User Login
    // Json read
    $string = file_get_contents("files/json/users.json");
    $json_array = json_decode($string, true);
    // Get Username
    $user = $_REQUEST['username'];
    // Making Auth
    // redirect page based on success
    if ($json_array[$user] == md5($_REQUEST['password'])) {
      $_SESSION['username'] = $user;
      header("Location:".BASE. '/shopview');
    }
    else {
      $_SESSION['login_step'] = 2;
      header("Location:".BASE. '/login');
    }
  }
?>