<?php require_once('../includes/initialize.php'); ?>
<?php 
	
	if($session->confirm_logged_in()) {
 		redirect_to("index_test_page.php");
	}

	if(isset($_POST['submit'])){
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);

		$found_user = Student::attempt_login($login, $password);

		if($found_user){
			$session->login_user($found_user);
			$session->message("All okay");
			redirect_to("started_test_page.php");
		} else {
			$session->message("All BAD");
		}
	} else {
		$login = "";
		$password = "";
	}

?>

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>


<form action="started_test_page.php" method="POST">
	<p>Введите LOGIN</p>
	<input type="text" name="login" />
	<p>Введите PASSWORD</p>
	<input type="text" name="password" /> <br><br><br><br>
	<input type="submit" name="submit" value="Отправить">
</form>


<?php include_layout_template('footer.php'); ?>
