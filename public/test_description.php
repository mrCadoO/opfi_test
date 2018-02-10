<?php require_once('../includes/initialize.php'); ?>
<?php $session->logged();  ?>	
<?php
	
	if(isset($_SESSION['get_data'])){
		if($_SESSION['get_data'] != $_GET['subject']){
			$_SESSION['get_data'] = null;
			$_SESSION['user_id'] = null;
			redirect_to("index.php");
		}
	} else {
		$_SESSION['get_data'] = $_GET['subject'];
	}


	$session->annulment(); //unnulment page and assesment
	if(isset($_POST['submit'])){
		$result = new Result();
		$user_id = $_SESSION['user_id'];
		$student = Student::find_by_id($user_id); 
		$test = group_Subject::find_by_id($_GET['subject']); 

		$result->first_name = $student->first_name;
		$result->last_name  = $student->last_name;
		$result->group_name = $student->group_name;
		$result->assessment = '0';
		$result->test_name = $test->name;
		$result->create();
		$_SESSION['Id'] = $result->id;
		redirect_to("time_to_tests.php?page=1&subject={$_GET['subject']}");
	}
?>


<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>

<?php
 	$subj = group_Subject::find_by_id($_GET['subject']);
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