<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
    	$session->message("Данныe не найдеы.");
    	redirect_to("current_test.php");
  	}
	$subject = Subjects::find_by_id($_GET['id']);

	if(!$subject) {
    	$session->message("Вопрос не найден.");
    	redirect_to("index.php");
  }

	if(isset($_POST['submit'])) {

		$subject->name = !empty($_POST['name']) ? $_POST['name'] : $subject->name;
		

	if($subject->update()){
		$session->message('Вопрос успешно обновлен.');
		redirect_to("current_test.php?subject={$subject->id}");
	}

	} 
?>

<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<form action="updata_subject.php?id=<?php echo $subject->id; ?>" method="POST">
<ul type="none">

	<li>	
		<?php echo $subject->name; ?>	
		<input type="text" name="name" value="" />
	</li>
	
</ul><br /><br /><br />
<input type="submit" name="submit" value="Обновить" />
</form>


<?php include_layout_template('admin_footer.php'); ?>