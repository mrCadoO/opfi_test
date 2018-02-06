<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	
<?php
	if(isset($_POST['submit'])){
		$validation = Student::find_all();
		foreach ($validation as $valid) {
			if($valid->login == $_POST['login']){
				$session->message("Пользователь с таким логином уже существует");
				redirect_to("create_student.php");
			}
		}
		$new_stud = new Student();
		$new_stud->first_name = $_POST['first_name'];
		$new_stud->last_name = $_POST['last_name'];
		$new_stud->group_name = $_POST['group_name'];
		$new_stud->login = $_POST['login'];
		$new_stud->hashed_password = password_encrypt($_POST['password']);
	if(empty($new_stud->first_name) || empty($new_stud->last_name) || empty($new_stud->group_name) || empty($new_stud->login) || empty($new_stud->hashed_password)){
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

	<p>Введите login</p>
	<input type="text" name="login" size="50" /><br /><br />

	<p>Введите пароль</p>
	<input type="text" name="password" size="50" /><br /><br />
	
	<p>Введите Имя</p>
	<input type="text" name="first_name" size="50" /><br /><br />

	<p>Введите Фамилию</p>
	<input type="text" name="last_name" size="50" /><br /><br />

	<p>Введите название группы</p>
	<select style="width: 325px;" name="group_name">
		<?php
			$groups = Groups::find_all();
			foreach ($groups as $group) {
				$output  = "<option";
				$output .= " value=\"";
				$output .= htmlentities($group->group_name);
				$output .= "\" >";
				$output .= htmlentities($group->group_name);
				$output .= "</option>";
				echo $output;
			}
		?>
	</select><br><br><br><br>

	<input type="submit" name="submit">
</form>



<?php include_layout_template('admin_footer.php'); ?>