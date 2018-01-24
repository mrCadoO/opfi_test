<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	
<?php
	if(isset($_POST['submit'])){
		$new_stud = new Start_student();
		$new_stud->first_name = $_POST['first_name'];
		$new_stud->last_name = $_POST['last_name'];
		$new_stud->group_name = $_POST['group_name'];
		$new_stud->private_number = $_POST['private_number'];
	if(empty($new_stud->first_name) || empty($new_stud->last_name) || empty($new_stud->group_name) || empty($new_stud->private_number)){
		$session->message('Заполните все поля');
		redirect_to('create_student.php');
	}
		if($new_stud->create()){
			$session->message('добавлен успешно');
			redirect_to('list_student.php');
		} else {
			$session->message('Что то пошло не так!!!! ERROR');
			redirect_to('create_student.php');
		} 
	}
?>



<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
		
<form action="create_student.php" method="post">
	
	<p>Введите Имя</p>
	<input type="text" name="first_name" size="50" /><br /><br />

	<p>Введите Фамилию</p>
	<input type="text" name="last_name" size="50" /><br /><br />

	<p>Введите название группы</p>
	<input type="text" name="group_name" size="50" /><br /><br />

	<p>Введите номер зачотной книжки</p>
	<input type="text" name="private_number" size="50" /><br /><br />

	<input type="submit" name="submit">
</form>



<?php include_layout_template('admin_footer.php'); ?>