<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	<?php include_layout_template('admin_header.php'); ?>
		<h2>Menu</h2>
		<?php echo output_message($message); ?>
		
	<ul>
		<li><a href="manage_test.php">Управление страничкой с тестами</a></li><br/>
		<li><a href="manage_student.php">Студенты</a></li><br/>
		<li><a href="logfile.php">Кто заходил как Администратор</a></li><br/>
		<li><a href="logout.php">Выйти</a></li><br/>

	</ul>
	</div>



	<?php include_layout_template('admin_footer.php'); ?>