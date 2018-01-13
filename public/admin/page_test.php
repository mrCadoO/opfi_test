<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	<?php include_layout_template('admin_header.php'); ?>
	<?php echo output_message($message); ?>




	<?php include_layout_template('admin_footer.php'); ?>