<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php 			
	$results = Students::find_all();
?>

<?php include_layout_template('admin_header.php'); ?>	
<a href="manage_student.php">&laquo; Назад</a><br /><br /><br />
<?php echo output_message($message); ?>

<table>
	<tr>
		<th style="text-align: left; width: 200px;">Имя</th>
		<th style="text-align: left; width: 200px;">Фамилия</th>
		<th style="text-align: left; width: 200px;">Группа</th>
		<th style="text-align: left; width: 200px;">Название теста</th>
		<th style="text-align: left; width: 200px;">Оценка</th>
	</tr>
<?php foreach ($results as $result): ?>
	<tr>
		<td><?php echo $result->first_name;?></td>
		<td><?php echo $result->last_name;?></td>
		<td><?php echo $result->group_name;?></td>
		<td><?php echo $result->test_name;?></td>
		<td><?php echo $result->assessment;?></td>
	</tr>	
<?php endforeach; ?>
	
</table>

<?php include_layout_template('admin_footer.php'); ?>