<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	
<?php
	if(isset($_POST['submit'])){
		if(!empty($_POST['test_name']) || !empty($_POST['group_name'])){
			$subject = new new_Subject();
			$subject->name = $_POST['test_name'];
			$session->message('успешно создана.');
			$subject->create();
			redirect_to("select_test.php?subject={$subject->id}");
			} else {
			$session->message('Заполните поле ввода');
			redirect_to('new_subject_for_user.php');	
			}
	}
?>

<?php include_layout_template('admin_header.php'); ?>

<form action="new_subject_for_user.php" method="post">
	<p>Название теста</p>
	<input type="text" name="test_name" />
	<input type="submit" name="submit" value="Отправить" />
</form>

<?php include_layout_template('admin_footer.php'); ?>