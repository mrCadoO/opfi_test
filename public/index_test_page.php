<?php require_once('../includes/initialize.php'); ?>
	
<?php if(!$session->access_permission()){redirect_to("started_test_page.php");}
?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); 
 $session->annulment();
?>





<?php list_test_for_user(); ?>

<br><br><br><br>

<a href="time_to_tests_low.php?page=1">Тесты легкого уровня</a>


<?php include_layout_template('footer.php'); ?>
