<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

	
<?php
	$subject = new group_Subject();
	$subject->name = "Без названия";
	$subject->group_name = " ";
	$subject->time = 300;
	if($subject->create()){
		$session->message('успешно создана.');	
		redirect_to("select_questions_for_group.php?subject={$subject->id}");
	} else{
		$session->message('Заполните поле ввода');
		redirect_to('create_group_subject.php');	
	}
?>

<?php if(isset($database)){ $database->close_connection(); } ?>