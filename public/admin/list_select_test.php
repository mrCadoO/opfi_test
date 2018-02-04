<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); }


?>



<?php include_layout_template('admin_header.php'); ?>	
<?php echo output_message($message); ?>
<a href="new_subject_for_user.php">Создать тест для студентов</a> <br/><br/><br/>
<?php 
 $results = new_Subject::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<a href=\"select_test.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\"> ";
      $output .= htmlentities($result->name);
      $output .= "</a>";
      $tests = Select::find_by_subject_id($result->id);
      foreach ($tests as $test):
        $output .= "<ul><li>";
        $output .= "<a href=\"current_question.php?test=";
        $output .= urlencode($test->id);
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul>";
      endforeach;
      $output .="</li>";
      echo $output;
    endforeach;
    echo "</ul>";


?>



<?php include_layout_template('admin_footer.php'); ?>