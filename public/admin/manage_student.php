<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test();

include_layout_template('admin_header.php'); ?>	
<?php echo output_message($message); ?>
<a href="index.php">&laquo; Назад</a> <br/><br/>

<ul>
<li><a href="list_group.php">Группы</a></li> <br/>
<li><a href="create_student.php">Создать информацию о студенте</a></li> <br/>
<li><a href="list_student.php">Студенты в БД</a></li> <br/>	
<li><a href="test_result.php">Результаты тестирования</a></li> <br/>	

</ul>
	
<?php include_layout_template('admin_footer.php'); ?>