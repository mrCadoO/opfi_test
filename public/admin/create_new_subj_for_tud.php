<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['user_id'])){
		$session->message("No  ID was provided.");
		redirect_to('new_subject_for_selected_stud.php');
	}

	$subject = new selected_stud_Subject();
		$subject->name = "Без названия";
		$subject->time = 300;
		$subject->user_id = $_GET['user_id'];
		if($subject->create()){
			$session->message('Страничка успешно создана.');
			redirect_to("select_questions_for_student.php?subject={$subject->id}");	
		} else {
			$session->message("Что то пошоло не так.");
			redirect_to("new_subject_for_selected_stud.php");
		}
?>

<?php if(isset($database)){ $database->close_connection(); } ?>