<?php require_once('../includes/initialize.php'); 




  





?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>

<?php
$arr = array_rand(range(0, 100), 100);
shuffle($arr);

	print_r($arr);
	


?>





<?php include_layout_template('footer.php'); ?>