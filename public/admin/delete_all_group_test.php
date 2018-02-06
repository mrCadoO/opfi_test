<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['id'])){
		$session->message("No test ID was provided.");
		redirect_to("index.php");
	}

	$subj = group_Subject::find_by_id($_GET['id']);
	$test = new group_Test();
		$test->delete_all_test_by_subject_id($_GET['id']);
		$subj->delete();
			$session->message("Удалено Успешно.");
			redirect_to("list_group_test.php");
		
?>

<?php if(isset($database)){ $database->close_connection(); } ?>