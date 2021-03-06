<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); }
find_selected_test(); 
$tests = Tests::find_tests_for_subject($current_subject); // if(!cuurent ...)
$subjects = Subjects::find_one_element($current_subject);
 ?>



<?php include_layout_template('admin_header.php'); ?>	
<a href="list_all_tests.php">&laquo; Назад</a>

<?php foreach ($subjects as $subject): ?>
<h2>Тесты: <?php echo $subject->name; ?> </h2>
<a href="updata_subject.php?id=<?php echo $subject->id; ?>">Обновка</a><br>
<a href="description_test.php?test_id=<?php echo $subject->id; ?>">Описание теста</a><br>
<a href="delete_subject.php?id=<?php echo $subject->id; ?>">Удалить все содержимое данного теста.</a>
<?php endforeach; ?>

<?php echo output_message($message); ?>


<?php if(isset($subject)){ ?>
<form method="POST">
<ul type="none">

<?php foreach ($tests as $test): ?>
	
	<li><?php echo $test->question; ?></li>
		<ul type="none">
			<li><?php
				if(!empty($test->answer1)){
					echo $test->answer1;
				if(!empty($test->truth1)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>

			<li><?php
				if(!empty($test->answer2)){
					echo $test->answer2;
				if(!empty($test->truth2)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>

			<li><?php
				if(!empty($test->answer3)){
					echo $test->answer3;
				if(!empty($test->truth3)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>

			<li><?php
				if(!empty($test->answer4)){
					echo $test->answer4;
				if(!empty($test->truth4)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>

			<li><?php
				if(!empty($test->answer5)){
					echo $test->answer5;
				if(!empty($test->truth5)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>

			<li><?php
				if(!empty($test->answer6)){
					echo $test->answer6;
				if(!empty($test->truth6)) { 
					echo "<input type=\"radio\" name=\"\" disabled checked >"; 
				} else {
					echo "<input type=\"radio\" name=\"\" disabled>"; }
				} ?>
			</li>	
		</ul>
	</li><br />

		
	<?php echo "<a href=\"updata_question.php?id={$test->id}\" >Обновка</a>"; ?>
	<?php echo "<a href=\"delete_question.php?id={$test->id}\" >Удалить</a>"; ?>
	<br><br><br><br>
<?php endforeach; ?>
</ul>
</form>

<br /><br /><br /><br />	
<div><a href="new_test.php?subject=<?php echo urlencode($current_subject); ?>">Добавить вопрос</a></div>
<?php } else { redirect_to("list_all_tests.php"); } ?>
<?php include_layout_template('admin_footer.php'); ?>