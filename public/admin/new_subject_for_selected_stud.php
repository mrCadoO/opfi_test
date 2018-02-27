<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } ?>

	
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
<a href="list_tests_for_selected_student.php">&laquo; Назад</a> <br/><br/>	

<?php 
	$results = Groups::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= htmlentities($result->group_name);
      $output .= "<ul type=\"none\">";
      $students = Student::find_stud_by_group($result->group_name);
      if($result){
      	foreach ($students as $student):
        	$output .= "<li>";
        	$output .= "<a href=\"create_new_subj_for_tud.php?user_id=";
        	$output .= urlencode($student->id);
        	$output .= "\">";
        	$output .= htmlentities($student->first_name);
        	$output .= " ";
        	$output .= htmlentities($student->last_name);
        	$output .= "</a></li>";
      	endforeach;
      		$output .= "</ul>";
  	  } else {
  	  	echo "У одного или более тестов отсутствует название, просьба обратиться к программисту.";
  	  }
      $output .="</li><br><br>";
      echo $output;
    endforeach;
    echo "</ul>";

 ?>


<?php include_layout_template('admin_footer.php'); ?>