<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test();

include_layout_template('admin_header.php'); ?>	

<a href="index.php">&laquo; Назад</a> <br/><br/><br/>
<a href="logfile.php">Кто заходил как Администратор</a><br/><br/>	
<a href="update_admin.php">Обнова данных</a><br/>	


<?php include_layout_template('admin_footer.php'); ?>