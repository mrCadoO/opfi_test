<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php

	if(empty($_GET['id'])){
		$session->message("No test ID was provided.");
		redirect_to('index.php');
	}

	$test = Tests::find_by_id($_GET['id']);
		if($test->delete()){
			$session->message("Удалено Успешно.");
			redirect_to("current_test.php?subject={$test->subject_id}");
		}
			
?>

<?php if(isset($database)){ $database->close_connection(); } ?>