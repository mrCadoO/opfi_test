<?php
require_once("../../includes/initialize.php");
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
?>

<?php
	if(empty($_GET['id'])){
		$session->message("No  ID was provided.");
		redirect_to('list_group.php');
	}

	$result = Groups::find_by_id($_GET['id']);;
		$result->delete();
		redirect_to("list_group.php");
?>

<?php if(isset($database)){ $database->close_connection(); } ?>