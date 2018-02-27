<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 
find_selected_test();

include_layout_template('admin_header.php'); ?>	
<a href="manage_test.php">&laquo; Назад</a> <br/><br/>
<a href="new_subject_for_selected_stud.php">Создать новый тест</a> <br/>	


<?php 
	$results = selected_stud_Subject::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<a href=\"select_questions_for_student.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\"> ";
      $output .= htmlentities($result->name);
      $output .= "</a>";
      $tests = selected_stud_Test::find_by_subject_id($result->id);
      if($result){
      	foreach ($tests as $test):
        	$output .= "<ul><li>";
        	$output .= "<a href=\"current_individual_question.php?test=";
        	$output .= urlencode($test->id);
        	$output .= "\">";
        	$output .= htmlentities($test->question);
        	$output .= "</a></li></ul>";
      	endforeach;
  	  } else {
  	  	echo "У одного или более тестов отсутствует название, просьба обратиться к программисту.";
  	  }
      $output .="</li><br><br>";
      echo $output;
    endforeach;
    echo "</ul>";

 ?>
	
	
<?php include_layout_template('admin_footer.php'); ?>