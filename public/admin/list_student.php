<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php 			
	$studs = Student::find_all();

?>

<?php include_layout_template('admin_header.php'); ?>	
<a href="manage_student.php">&laquo; Назад</a><br /><br /><br />
<?php echo output_message($message); ?>

<table>
	<tr>
		<th style="text-align: left; width: 200px;">Имя</th>
		<th style="text-align: left; width: 200px;">Фамилия</th>
		<th style="text-align: left; width: 200px;">Группа</th>
		<th style="text-align: left; width: 200px;">Изменить/Удалить</th>
	</tr>
<?php foreach ($studs as $stud): ?>
	<tr>
		<td><?php echo $stud->first_name;?></td>
		<td><?php echo $stud->last_name;?></td>
		<td><?php echo $stud->group_name;?></td>
		<td><a href="updata_student.php?id=<?php echo $stud->id; ?>">Изменить</a>/<a href="delete_student.php?id=<?php echo $stud->id; ?>">Удалить</a></td>
	</tr>
<?php endforeach; ?>
</table>




<?php include_layout_template('admin_footer.php'); ?>