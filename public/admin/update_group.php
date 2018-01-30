<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

<?php
	$result = Groups::find_by_id($_GET['id']);

	if(isset($_POST['submit'])){
		if(!empty($_POST['group_name'])){
			$result->group_name = $_POST['group_name'];
			$session->message('Информация успешно обновлена.');
			$result->update();
			redirect_to("list_group.php");
			} else {
			$session->message('Заполните поле ввода');
			redirect_to("update_group.php?id={$result->id}");	
			}
	}
?>

<?php include_layout_template('admin_header.php'); ?>

<form action="update_group.php?id=<?php echo $result->id; ?>" method="post">
	<p>Название группы : <?php echo $result->group_name; ?></p>
	<input type="text" name="group_name" value="<?php echo $result->group_name; ?>" /><br><br><br><br>
	<input type="submit" name="submit" value="Отправить" />
</form>

<?php include_layout_template('admin_footer.php'); ?>