<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>



<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>



<?php
  //find all test name
	$results = new_Subject::find_all();
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
