<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>



<?php
  $_SESSION['get_data'] = null;
  $stud = Student::find_by_id($_SESSION['user_login']);
	$results = group_Subject::find_by_group_name($stud->group_name);
  if($results){
    foreach ($results as $result){
      $output  = "<a href=\"test_description.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\" "; 
      $output .= "style=\"margin-left: 60px;\" ";
      $output .= ">";
      $output .= htmlentities($result->name);
      $output .= "</a><br><br>";
      echo $output;
    }
  }else{
    echo "В данный момент доступных тестов нету.";
  }
?>

<?php include_layout_template('footer.php'); ?>
