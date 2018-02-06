<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); }


?>


<?php include_layout_template('admin_header.php'); ?>	
<?php echo output_message($message); ?>
<a href="create_group_subject.php">Создать тест для студентов</a> <br/><br/><br/>
<?php 
 $results = group_Subject::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "Группа: ";
      $output .= htmlentities($result->group_name);
      $output .= "<br>";
      $output .= "<a href=\"select_questions_for_group.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\"> ";
      $output .= htmlentities($result->name);
      $output .= "</a>";
      $tests = group_Test::find_by_subject_id($result->id);
      foreach ($tests as $test):
        $output .= "<ul><li>";
        $output .= "<a href=\"current_group_question.php?test=";
        $output .= urlencode($test->id);
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul>";
      endforeach;
      $output .="</li><br><br>";
      echo $output;
    endforeach;
    echo "</ul>";


?>



<?php include_layout_template('admin_footer.php'); ?>