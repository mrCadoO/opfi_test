<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['subject']) || empty($_GET['test'])){
		redirect_to("list_tests_for_selected_student.php");
	}

	$test = Tests::find_by_id($_GET['test']);
	$result = new selected_stud_Test();
	$result->question = $test->question;
	$result->answer1 = $test->answer1;
	$result->answer2 = $test->answer2;
	$result->answer3 = $test->answer3;
	$result->answer4 = $test->answer4;
	$result->answer5 = $test->answer5;
	$result->answer6 = $test->answer6;
	$result->truth1 = $test->truth1;
	$result->truth2 = $test->truth2;
	$result->truth3 = $test->truth3;
	$result->truth4 = $test->truth4;
	$result->truth5 = $test->truth5;
	$result->truth6 = $test->truth6;
	$result->subject_id = $_GET['subject'];
	$result->create();
	$session->message("all okay");
	redirect_to("select_questions_for_student.php?subject={$_GET['subject']}");
?>

<?php if(isset($database)){ $database->close_connection(); } ?>	