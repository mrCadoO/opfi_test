<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test(); 
$test = group_Test::find_by_id($current_test); ?>

<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<a href="manage_test.php">&laquo; Назад</a>


<form method="POST">
<ul type="none">
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
</ul>
</form>

<?php include_layout_template('admin_footer.php'); ?>