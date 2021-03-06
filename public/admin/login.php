<?php
require_once("../../includes/initialize.php");

if($session->is_loged_in()) {
  redirect_to("index.php");
}

if(isset($_POST['submit'])) { 
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.


	$found_admin = Admin::attempt_login($username, $password);
	
  if($found_admin) {
    $session->login($found_admin);
	log_action('Login', "{$found_admin->username} logged in.");
    redirect_to("index.php");
  } else {
    $message = "Username/password combination incorrect.";
  }
  
} else { 
  $username = "";
  $password = "";
  $message = "";
}

?>
<?php include_layout_template('admin_header.php'); ?>

		<h2>Staff Login</h2>
		<?php echo output_message($message); ?>

		<form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>

<?php include_layout_template('admin_footer.php'); ?>
