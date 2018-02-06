<?php
require_once("../../includes/initialize.php"); ?>
<?php if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

<?php
	if(empty($_GET['id'])){
		$session->message("No test ID was provided.");
		redirect_to('index.php');
	}

	$subject = Subjects::find_by_id($_GET['id']);
	$test = new Tests();
		$test->delete_all_test_by_subject_id($_GET['id']);
		$subject->delete();
		redirect_to("list_all_tests.php");
		
?>

<?php if(isset($database)){ $database->close_connection(); } ?>