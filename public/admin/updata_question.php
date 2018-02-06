<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
    	$session->message("Данный вопрос не найден.");
    	redirect_to("current_test.php");
  	}
	$test = Tests::find_by_id($_GET['id']);

	if(!$test) {
    	$session->message("Вопрос не найден.");
    	redirect_to("index.php");
  }

	if(isset($_POST['submit'])) {

		$test->question = !empty($_POST['question']) ? $_POST['question'] : $test->question;
		$test->subject_id = $test->subject_id;
		$test->answer1  = !empty($_POST['answer1']) ? $_POST['answer1'] : $test->answer1;
		$test->answer2  = !empty($_POST['answer2']) ? $_POST['answer2'] : $test->answer2;
		$test->answer3  = !empty($_POST['answer3']) ? $_POST['answer3'] : $test->answer3;
		$test->answer4  = !empty($_POST['answer4']) ? $_POST['answer4'] : $test->answer4;
		$test->answer5  = !empty($_POST['answer5']) ? $_POST['answer5'] : $test->answer5;
		$test->answer6  = !empty($_POST['answer6']) ? $_POST['answer6'] : $test->answer6;

	$check = isset($_POST['truth']) ? $_POST['truth'] : null;
	for($i=0; $i < 1; $i++){
		$test->truth1  = $check[$i]==1 ? "true" : null;
		$test->truth2  = $check[$i]==2 ? "true" : null;
		$test->truth3  = $check[$i]==3 ? "true" : null;
		$test->truth4  = $check[$i]==4 ? "true" : null;
		$test->truth5  = $check[$i]==5 ? "true" : null;
		$test->truth6  = $check[$i]==6 ? "true" : null;
	}

	if($test->update()){
		$session->message('Вопрос успешно обновлен.');
		redirect_to("current_test.php?subject={$test->subject_id}");
	} else {
		$session->message("Что то пошло не так!");
	}


	
	} 
?>

<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<form action="updata_question.php?id=<?php echo $test->id; ?>" method="POST">
<ul type="none">

	<li>	
		<?php echo $test->question; ?>	
		<input type="text" name="question" value="" />
	</li><br/><br/>
	
	<li><?php 
		if(!empty($test->answer1)){
			echo $test->answer1; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="1" />
		<input type="text" name="answer1" value="" />
	</li><br/><br/>

	<li><?php 
		if(!empty($test->answer2)){
			echo $test->answer2; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="2" />
		<input type="text" name="answer2" value="" />
	</li><br/><br/>
	

	<li><?php 
		if(!empty($test->answer3)){
			echo $test->answer3; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="3" />
		<input type="text" name="answer3" value="" />
	</li><br/><br/>

	<li><?php 
		if(!empty($test->answer4)){
			echo $test->answer4; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="4" />
		<input type="text" name="answer4" value="" />
	</li><br/><br/>

	<li><?php 
		if(!empty($test->answer5)){
			echo $test->answer5; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="5" />
		<input type="text" name="answer5" value="" />
	</li><br/><br/>

	<li><?php 
		if(!empty($test->answer6)){
			echo $test->answer6; } else {echo "Вопрос не задан."; } ?>
		<input type="radio" name="truth[]" value="6" />
		<input type="text" name="answer6" value="" />
	</li><br/><br/>
</ul><br /><br /><br />
<input type="submit" name="submit" value="Обновить" />
</form>


<?php include_layout_template('admin_footer.php'); ?>

