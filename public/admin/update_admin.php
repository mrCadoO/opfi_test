<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php


	if(isset($_POST['submit'])){
	$admin = Admin::find_by_id(1);	
	$admin->username = !empty($_POST['username']) ? $_POST['username'] : $admin->username;
	$admin->password = !empty($_POST['password']) ? password_encrypt($_POST['password']) : $admin->password;
    if($admin->update()){
    	$session->message("Информация успешно обновлена");
    	redirect_to("update_admin.php");
    } else {
    	$session->message("Произошла ошибка");
    	redirect_to("update_admin.php");
    }
}

?>




<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<form action="update_admin.php" method="POST">
	<p>Username</p>
<input type="text" name="username">

	<p>Password</p>
<input type="text" name="password">
<br><br><br>
	
	

<input type="submit" name="submit" value="Обновить" />
</form>


<?php include_layout_template('admin_footer.php'); ?>