<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>



<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>



<?php
  $stud = Start_student::find_by_id($_SESSION['user_login']);

  //find all test name
	$results = new_Subject::find_by_group_name($stud->group_name);
  if($results){
    echo "<ul type=\"none\">";
    foreach ($results as $result){
      $output  = "<li>";
      $output .= "<a href=\"test_description.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\"> ";
      $output .= htmlentities($result->name);
      $output .= "</a>";
      echo $output;
    }
  }else{
    echo "В данный момент доступных тестов нету.";
  }
?>



<?php include_layout_template('footer.php'); ?>
