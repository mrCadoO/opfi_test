<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test();

include_layout_template('admin_header.php'); ?>	

<a href="index.php">&laquo; Назад</a> <br/><br/><br/>
<a href="list_all_tests.php">Общий список тестов</a> <br/><br/>	
<a href="list_group_test.php">Список тестов для групп</a> <br/><br/>	
<a href="list_tests_for_selected_student.php">Список тестов для студентов</a> <br/><br/><br/>	
<?php include_layout_template('admin_footer.php'); ?>