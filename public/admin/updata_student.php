<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
    	$session->message("Данныe не найдеы.");
    	redirect_to('list_student.php');
  	}
	$stud = Student::find_by_id($_GET['id']);

	if(!$stud) {
    	$session->message("Данные не найден.");
    	redirect_to('list_student.php');
  }

	if(isset($_POST['submit'])) {
		$stud->first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : $stud->first_name;
		$stud->last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : $stud->last_name;
		$stud->group_name = !empty($_POST['group_name']) ? $_POST['group_name'] : $stud->group_name;
		if($stud->update()){
			$session->message('Данныe успешно обновлены.');
			redirect_to("list_student.php");
		}
	} 
?>

<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<form action="updata_student.php?id=<?php echo $stud->id; ?>" method="POST">
<ul type="none">

	<li><?php echo $stud->first_name; ?><br><input type="text" name="first_name" value="" /></li><br>

	<li><?php echo $stud->last_name; ?><br><input type="text" name="last_name" value="" /></li><br>

	<li><?php echo $stud->group_name; ?><br><input type="text" name="group_name" value="" /></li><br>
	
</ul><br /><br /><br />
<input type="submit" name="submit" value="Обновить" />
</form>


<?php include_layout_template('admin_footer.php'); ?>