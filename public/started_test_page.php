<?php require_once('../includes/initialize.php'); ?>
<?php 

	if(isset($_POST['submit'])){
		$student = new Start_student();
		$student->login = $_POST['login'];
		$student->hashed_password = $_POST['password'];

		$found_user = $student->attempt_login($student->login, $student->hashed_password);
		$_SESSION["user_login"] = $found_user["id"];
		$_SESSION["username"] = $found_user["login"];
		if($found_user){
			$session->message("All okay");
			redirect_to("index_test_page.php");
		} else {
			$session->message("All BAD");
			redirect_to("started_test_page.php");
		}
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
