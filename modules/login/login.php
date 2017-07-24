  <?php
    session_start();
    form_processor();
  	heading();
  ?>
  <div class="wrapper">
    <form class="form-signin" action="<?php echo BASE ?>/login/?process=login" method="post">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="username" placeholder="User Name" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/> <br> <?php

      if ($_SESSION['myVar'] == 2) { ?>
        <label style="color: red;">Username or Password don't match.</label>        
      <?php }
        $_SESSION['myVar'] = 0;
      ?>     
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Login</button>  
    </form>
    <?php
        function process_login() {
          $user = $_REQUEST['username'];
          $pass = $_REQUEST['password'];
          $flag = 0;

          $json_url = "files/json/users.json";
          $data = file_get_contents($json_url);
          $json= json_decode($data, TRUE);

          foreach ($json as $key => $value) {
              if (!is_array($value)) {
                  if (($key == $user) && ($value == $pass)) {
                    $flag = 1;
                    break;
                  }
                  else{
                    $flag = 0;
                  }

              } else {
                  foreach ($value as $key => $val) {
                      echo $key . '=>' . $val . '<br/>';
                  }
              }
          }
          

           if ($flag == 1) {
            $_SESSION['username'] = $user;
             header("Location:".BASE. '/shopview');
           }
           else {
            $flag = 2;
            $_SESSION['myVar'] = $flag;
            header("Location:".BASE. '/login');
           }
        }
    ?>

  </div>
  <?php
  	footing();
  ?>