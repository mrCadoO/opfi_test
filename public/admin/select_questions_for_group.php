<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 

$subject = $_GET['subject'];
if(!$subject){
	redirect_to("manage_test.php");
}
$subj = group_Subject::find_by_id($subject);
	if(!$subj->id){
		redirect_to("manage_test.php");
	}

	if(isset($_POST['submit'])){
		if($_POST['time'] >= 60){
			$time = 59 * 60;
		} else {
			$time = (int)$_POST['time'] *60;
		}
		$subj->time = !empty($_POST['time']) ? (int)$time : $subj->time;
		$subj->update();
		redirect_to("select_questions_for_group.php?subject={$subject}");

	}


include_layout_template('admin_header.php'); ?>	
<a href="list_group_test.php">&laquo; Назад</a> <br/><br/>	

<table>
<tr><th style="text-align: left; width: 600px;"><?php 
	$results = Subjects::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<h2>";
      $output .= htmlentities($result->name);
      $tests = Tests::find_tests_for_subject($result->id);
      foreach ($tests as $test):
        $output .= "</h2><ul><li>";
        $output .= "<a href=\"create_group_test.php?test=";
        $output .= urlencode($test->id);
        $output .= "&subject={$_GET['subject']}";
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul><br>";
      endforeach;
      $output .="</li><br>";
      echo $output;
    endforeach;
    echo "</ul>";
 ?></th>

<th style="width: 400px;"><?php
	$output  = htmlentities($subj->group_name);
	$output .= "<br><br>";
	$output .= "<a href=\"delete_all_group_test.php?id=";
	$output .= urlencode($subj->id);
	$output .= "\">";
	$output .= htmlentities($subj->name);
	$output .= "</a><br><br>";
	echo $output;
	$results = group_Test::find_by_subject_id($subject); 
	if(isset($results)){
		foreach($results as $result){
			$output  = htmlentities($result->question);
			$output .= "<br>";
			$output .= "<div id=\"delete_select_test\">";
			$output .= "<a href=\"delete_group_test.php?id=";
			$output .= urlencode($result->id);
			$output .= "\">";
			$output .= "Удалить</a><br><br><br></div>";
			echo $output;
		}
	}
?></th>
<th style="width: 300px; ">
	<form action="select_questions_for_group.php?subject=<?php echo $subject; ?>" method="POST">
	<p>Время на проведение теста: <?php echo $subj->time/60 . " мин."; ?></p>
<input type="text" name="time">	мин
<br><br>
<input type="submit" name="submit">
</form></th>
</tr>

</table>	


<?php include_layout_template('admin_footer.php'); ?>