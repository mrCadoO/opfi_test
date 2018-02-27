<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['id'])){
		$session->message("No test ID was provided.");
		redirect_to("index.php");
	}

	$subj = selected_stud_Subject::find_by_id($_GET['id']);
	$test = new selected_stud_Test();
		$test->delete_all_test_by_subject_id($_GET['id']);
		$subj->delete();
			$session->message("Удалено Успешно.");
			redirect_to("list_tests_for_selected_student.php");
		
?>

<?php if(isset($database)){ $database->close_connection(); } ?>