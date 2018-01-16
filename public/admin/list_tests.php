<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); }
find_selected_test(); 
$tests = Tests::find_tests_for_subject($current_subject); // if(!cuurent ...)
$subjects = Subjects::find_name_by_id($current_subject);
 ?>



<?php include_layout_template('admin_header.php'); ?>	
<a href="index.php">&laquo; Назад</a>

<?php foreach ($subjects as $subject): ?>
<h2>Тесты: <?php echo $subject->name; ?> </h2>
<?php endforeach; ?>

<?php echo output_message($message); ?>



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

		
	<?php echo "<a href=\"updata_test.php?id={$test->id}\" >Обновка</a>"; ?>
<?php endforeach; ?>
</ul>
</form>

<br /><br /><br /><br />	
<div><a href="new_test.php?subject=<?php echo urlencode($current_subject); ?>">Добавить новый тест</a></div>
<?php include_layout_template('admin_footer.php'); ?>