<?php require_once('../includes/initialize.php'); ?>
<?php $session->logged();  ?>



<?php $stud = Student::find_by_id($_SESSION['user_id']);?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>
<?php echo $stud->full_name() . ", для вас доступны тесты:<br><br> "; ?>


<?php
  $_SESSION['get_data'] = null;
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
