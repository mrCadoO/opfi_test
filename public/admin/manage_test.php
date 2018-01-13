<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test();

include_layout_template('admin_header.php'); ?>	
<a href="index.php">&laquo; Назад</a>
<?php admin_test(); ?>
	
			
<?php include_layout_template('admin_footer.php'); ?>