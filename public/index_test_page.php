<?php require_once('../includes/initialize.php'); ?>
	

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); 
 $user_id = $_SESSION['user_login'];
 $session->annulment();
?>





<?php list_test_for_user($user_id); ?>

<br><br><br><br>

<a href="time_to_tests_low.php?page=1">Тесты легкого уровня</a>


<?php include_layout_template('footer.php'); ?>
