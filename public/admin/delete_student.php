<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['id'])){
		$session->message("No student ID was provided.");
		redirect_to('list_student.php');
	}

	$stud = Start_student::find_by_id($_GET['id']);
		$stud->delete();
		$session->message("Информация успешно удалена.");
		redirect_to("list_student.php");
?>

<?php if(isset($database)){ $database->close_connection(); } ?>