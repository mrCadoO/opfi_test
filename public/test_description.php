<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>	
<?php
	
	if(isset($_SESSION['get_data'])){
		if($_SESSION['get_data'] != $_GET['subject']){
			$_SESSION['get_data'] = null;
			$_SESSION['user_login'] = null;
			redirect_to("index.php");
		}
	} else {
		$_SESSION['get_data'] = $_GET['subject'];
	}


	$session->annulment(); //unnulment page and assesment
	if(isset($_POST['submit'])){
		$new_stud = new Students();
		$user_id = $_SESSION['user_login'];
		$student = Start_student::find_by_id($user_id); 
		$test = new_Subject::find_by_id($_GET['subject']); 

		$new_stud->first_name = $student->first_name;
		$new_stud->last_name  = $student->last_name;
		$new_stud->group_name = $student->group_name;
		$new_stud->assessment = '0';
		$new_stud->test_name = $test->name;
		$new_stud->create();
		$_SESSION['Id'] = $new_stud->id;
		redirect_to("time_to_tests.php?page=1&subject={$_GET['subject']}");
	}
?>


<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>

<?php
 	$subj = new_Subject::find_by_id($_GET['subject']);
 	echo "Тема: ". $subj->name . "<br><br><br><br>";

 	$info = Description_test::find_by_test_id($_GET['subject']);
	if(isset($info->description)){
		echo "Описание: ". $info->description . "<br><br>";
	} else {
		echo "Описание: "."Информация отстствует."."<br><br>";
	}
 ?>


<form action="test_description.php?subject=<?php echo $_GET['subject'];?>" method="POST">
	
	<input type="submit" name="submit" value="Начать тестирование">

</form>


<?php include_layout_template('footer.php'); ?>