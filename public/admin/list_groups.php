<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

<?php
	if(isset($_POST['submit'])){
		$result = new Groups();
		$result->group_name = $_POST['group_name'];
		if(!empty($result->group_name)){
			$session->message("Группа создана.");
			$result->create();
			redirect_to("list_groups.php");
		} else {
			$session->message("Неверное название группы.");
			redirect_to("list_groups.php");
		}
	}
?>


<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
<?php $results = Groups::find_all(); ?>

<form action="list_group.php" method="POST">
	<input type="text" name="group_name">
	<input type="submit" name="submit">
</form><br><br><br><br><br>

<table>
	<tr>
		<th style="text-align: left; width: 200px;">Название группы<br><br></th>
		<th style="text-align: left; width: 200px;">Изменить/Удалить<br><br></th>
	</tr>
<?php foreach ($results as $result): ?>
	<tr>
		<td><?php echo $result->group_name;?></td>
		<td><a href="update_group.php?id=<?php echo $result->id; ?>">Изменить</a>/<a href="delete_group.php?id=<?php echo $result->id; ?>">Удалить</a></td>
	</tr>
<?php endforeach; ?>
</table>


<?php include_layout_template('admin_footer.php'); ?>