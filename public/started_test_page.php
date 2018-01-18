<?php require_once('../includes/initialize.php'); ?>
<?php 
	if(isset($_POST['submit'])){
		$student = new Students;
		$student->first_name = $_POST['first_name'];
		$student->last_name = $_POST['last_name'];
		$student->group_name = $_POST['group_name'];
		$student->assessment = 0;
		if(empty($student->first_name) || empty($student->last_name) || empty($student->group_name)){
			$session->message("Необходимо заполнить все поля.");
			redirect_to("started_test_page.php");
		} else {
			if($student->create()){
				$session->access_true();
				$session->annulment();
				redirect_to("index_test_page.php?user_id={$student->id}");
			} else{
				redirect_to("started_test_page.php");
			}
		}

	}



?>

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>


<form action="started_test_page.php" method="POST">
	<p>Введите Имя</p>
	<input type="text" name="first_name" />
	<p>ведите фамилию</p>
	<input type="text" name="last_name" />
	<p>Введите название группы</p>
	<input type="text" name="group_name" /><br /><br />
	<input hidden type="text" name="assessment" /><br /><br />
	<input type="submit" name="submit" value="Отправить">
	</form>



<?php include_layout_template('footer.php'); ?>
