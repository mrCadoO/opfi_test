<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php find_selected_test(); ?>
	
<?php
	if(isset($_POST['submit'])){
		$test = new Tests();
		$subject = new Subjects();
		$test->question = $_POST['question'];
		$test->subject_id = $current_subject;
		$test->answer1 = $_POST['answer1'];
		$test->answer2 = $_POST['answer2'];
		$test->answer3 = $_POST['answer3'];
		$test->answer4 = $_POST['answer4'];
		$test->answer5 = $_POST['answer5'];
		$test->answer6 = $_POST['answer6'];

		$check = isset($_POST['truth']) ? $_POST['truth'] : null;
		for($i=0; $i < 1; $i++){
			$test->truth1  = $check[$i]==1 ? "true" : null;
			$test->truth2  = $check[$i]==2 ? "true" : null;
			$test->truth3  = $check[$i]==3 ? "true" : null;
			$test->truth4  = $check[$i]==4 ? "true" : null;
			$test->truth5  = $check[$i]==5 ? "true" : null;
			$test->truth6  = $check[$i]==6 ? "true" : null;
		}
		if($test->create()){
			$session->message('Тест добавлен успешно');
			redirect_to('list_tests.php?subject='.urlencode($current_subject));
		} else {
			$session->message('Что то пошло не так!!!! ERROR');
			redirect_to('list_tests.php');
		} 
	}
?>






<?php include_layout_template('admin_header.php'); ?>

<a href="list_tests.php?subject=<?php echo urlencode($current_subject); ?>">&laquo; Назад</a>
<?php echo output_message($message); ?>
		
<form action="new_test.php?subject=<?php echo urlencode($current_subject); ?>" method="post">
<h2>Question</h2>

	<?php 
	if(isset($_POST['sub'])){
		echo "<input type=\"text\" name=\"answer1\" size=\"50\" />";
	}

?>	
	<p>Название вопроса</p>
	<input type="text" name="question" size="150" />
	<br /><br />
	
	<p>Ответы</p>
	<input type="text" name="answer1" size="50" />
	<input type="radio" name="truth[]" value="1" />
	<br /><br />
	
	<input type="text" name="answer2" size="50" />
	<input type="radio" name="truth[]" value="2" />
	<br /><br />	
	
	<input type="text" name="answer3" size="50" />
	<input type="radio" name="truth[]" value="3" />
	<br /><br />
	
	<input type="text" name="answer4" size="50" />
	<input type="radio" name="truth[]" value="4" />		
	<br /><br />
	
	<input type="text" name="answer5" size="50" />
	<input type="radio" name="truth[]" value="5" />	
	<br /><br />
	
	<input type="text" name="answer6" size="50" />
	<input type="radio" name="truth[]" value="6" />
	<br /><br />

	<input type="submit" name="submit">
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</form>



<?php include_layout_template('admin_footer.php'); ?>