<?php require_once('../includes/initialize.php'); ?>
	
<?php if(!$session->access_permission()){redirect_to("started_test_page.php");}
?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>

<a href="time_to_tests?page=1.php">Тесты сложного уровня</a> <br/><br/><br/>
<a href="time_to_tests_low?page=1.php">Тесты легкого уровня</a>


<?php include_layout_template('footer.php'); ?>
