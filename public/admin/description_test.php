<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php
	$test_id = $_GET['test_id'];
	if(!$test_id){
		$session->message("Неверный id теста");
		redirect_to("index.php");
	}

	if(isset($_POST['submit'])){
		$info = new Description_test();
		$info->description = !empty($_POST['comment']) ? $_POST['comment'] : "Информация отстствует.";
		$info->test_id = $test_id;
		$information = Description_test::find_by_test_id($test_id);
		$info->save($test_id);
		redirect_to("current_test.php?subject={$test_id}");
	}
?>

<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
		
<?php
	$info = Description_test::find_by_test_id($test_id);
	if(isset($info->description)){
		echo "Описание: ". $info->description . "<br><br>";
	} else {
		echo "Описание: "."Информация отстствует."."<br><br>";
	}
	
?>






<form action="description_test.php?test_id=<?php echo $test_id; ?>" method="POST">
	<textarea name="comment" cols="40" rows="3"><?php if(isset($info->description)){echo $info->description;}else{echo "Информация отстствует.";} ?></textarea></p>
	<input type="submit" name="submit">

</form>




<?php include_layout_template('admin_footer.php'); ?>