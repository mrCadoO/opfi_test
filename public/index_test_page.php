<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>	

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); 
 $user_id = $_SESSION['user_login'];
?>



<?php list_test_for_user($user_id); ?>

<br><br><br><br>
<?php include_layout_template('footer.php'); ?>
