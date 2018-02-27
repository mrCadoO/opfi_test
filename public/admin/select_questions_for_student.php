<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 

$subject = $_GET['subject'];
if(!$subject){
	redirect_to("manage_test.php");
}
$subj = selected_stud_Subject::find_by_id($subject);
	if(!$subj->id){
		redirect_to("manage_test.php");
	}

	if(isset($_POST['submit_subj_time'])){
		if($_POST['subj_time'] >= 60){
			$time = 59 * 60;
		} else {
			$time = (int)$_POST['subj_time'] *60;
		}
		$subj->time = !empty($_POST['subj_time']) ? (int)$time : $subj->time;
		$subj->update();
		redirect_to("select_questions_for_student.php?subject={$subject}");

	}

	if(isset($_POST['submit_subj_name'])){
		$subj->name = !empty($_POST['subj_name']) ? $_POST['subj_name'] : $subj->name;
		$subj->update();
		redirect_to("select_questions_for_student.php?subject={$subject}");
	}


include_layout_template('admin_header.php'); ?>	

<script type="text/javascript">

	window.onload = function() {
	document.getElementById("mainBox").addEventListener('click', invisBox1Open);
	document.getElementById("invisBox1Close").addEventListener('click', invisBox1Closet);
	document.getElementById("timeBox").addEventListener('click', invisBox2Open);
	document.getElementById("invisBox2Close").addEventListener('click', invisBox2Closet);
	};

	function invisBox1Open(){
		var invisBox1=document.getElementById("invisBox1").style;
 		var invisBox2=document.getElementById("invisBox2").style;
		invisBox1.display="block";
		invisBox2.display="none";
 	};

 	function invisBox1Closet(){
		var obj=document.getElementById("invisBox1").style;
		obj.display="none";
 	};	

 	function invisBox2Open(){
		var obj=document.getElementById("invisBox2").style;
		obj.display="block";
 	};

 	function invisBox2Closet(){
		var obj=document.getElementById("invisBox2").style;
		obj.display="none";
 	};

</script>

<a href="new_subject_for_selected_stud.php">&laquo; Назад</a> <br/><br/>	

<table>
<tr><th style="text-align: left; width: 500px;"><?php 
	$results = Subjects::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<h2>";
      $output .= htmlentities($result->name);
      $tests = Tests::find_tests_for_subject($result->id);
      foreach ($tests as $test):
        $output .= "</h2><ul><li>";
        $output .= "<a href=\"create_student_test.php?test=";
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

<th>
	<?php
	$output  = "<br><br>";
	$output .= "Студент: ";
	$output .= "<a href=\"delete_all_student_test.php?id=";
	$output .= urlencode($subj->id);
	$output .= "\">";
	$stud = Student::find_by_id($subj->user_id);
	$output .= htmlentities($stud->full_name());
	$output .= "</a><br><br>";
	$output .= "<div id=\"mainBox\"  >";
	$output .= "Название теста:   ";
	$output .= htmlentities($subj->name);
	$output .= "</div>";
	$output .= "<div id=\"invisBox1\">";
	$output .= "<div id=\"invisBox1Close\">x</div>";
	$output .= "<form method=\"POST\" action=\"select_questions_for_student.php?subject=";
	$output .= urlencode($subj->id);
	$output .= "\"><br><br>";
	$output .= "<input type=\"text\" name=\"subj_name\" ";
	$output .= "value=\"";
	$output .= htmlentities($subj->name);
	$output .= "\" ";
	$output .= "id=\"inp_subj_name\"><br><br>";
	$output .= "<input type=\"submit\" name=\"submit_subj_name\" ";
	$output .= "value=\"Сохранить\" id=\"submit_subj_name\">";
	$output .= "</form>";
    $output .= "</div><br>";
    $output .= "<div id=\"timeBox\">";
    $output .= "Время на проведение теста: ";
    $output .= htmlentities($subj->time) / 60 . " мин";
    $output .= "</div>";
    $output .= "<div id=\"invisBox2\">";
    $output .= "<div id=\"invisBox2Close\" >x</div>";
	$output .= "<form method=\"POST\" action=\"select_questions_for_student.php?subject=";
	$output .= urlencode($subj->id);
	$output .= "\"><br>";
	$output .= "<input type=\"text\" name=\"subj_time\" ";
	$output .= "value=\"";
	$output .= htmlentities($subj->time) / 60;
	$output .= "\" ";
	$output .= "id=\"inp_subj_time\"> мин<br><br>";
	$output .= "<input type=\"submit\" name=\"submit_subj_time\" ";
	$output .= "value=\"Сохранить\" id=\"submit_subj_time\">";
	$output .= "</form>";
    $output .= "</div><br>";
	echo $output;
	$results = selected_stud_Test::find_by_subject_id($subject); 
	if(isset($results)){
		foreach($results as $result){
			$output  = htmlentities($result->question);
			$output .= "<br>";
			$output .= "<div id=\"delete_select_test\">";
			$output .= "<a href=\"delete_student_test.php?id=";
			$output .= urlencode($result->id);
			$output .= "\">";
			$output .= "Удалить</a><br><br><br></div>";
			echo $output;
		}
	}
?></th>


</table>	


<?php include_layout_template('admin_footer.php'); ?>