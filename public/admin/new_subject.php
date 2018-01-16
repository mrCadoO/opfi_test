<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	
<?php
	if(isset($_POST['submit'])){
		if(!empty($_POST['test_name']) || !empty($_POST['group_name'])){
			$subject = new Subjects();
			$subject->name = $_POST['test_name'];
			$subject->group_name = $_POST['group_name'];
			$session->message('Страничка успешно создана.');
			$subject->create();
			redirect_to('index.php');
			} else {
			$session->message('Заполните поле ввода');
			redirect_to('new_subject.php');	
			}
	}
?>

<?php include_layout_template('admin_header.php'); ?>

<form action="new_subject.php" method="post">
	<p>Название теста</p>
	<input type="text" name="test_name" />
	<p>Группа</p>
	<input type="text" name="group_name" /> <br><br><br><br>
	<input type="submit" name="submit" value="Отправить" />
</form>

<?php include_layout_template('admin_footer.php'); ?>