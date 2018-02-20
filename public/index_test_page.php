<?php require_once('../includes/initialize.php'); ?>
<?php $session->logged();  ?>



<?php $stud = Student::find_by_id($_SESSION['user_id']);?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>
<?php echo $stud->full_name() . ", для вас доступны тесты:<br><br> "; ?>


<?php
  $_SESSION['get_data'] = null;
  $first_name = $stud->first_name;
  $last_name = $stud->last_name;
  $group_name = $stud->group_name;
  $db_ress = Result::find_by_result($first_name, $last_name, $group_name);
  if($db_ress){
    foreach ($db_ress as $db_res) {
     $arr[] = $db_res->test_name;
  }
    } else{
      $arr[] = "012bgg";
    }

	$results = group_Subject::find_by_group_name($stud->group_name);
  if($results){
    foreach ($results as $result){
    //  if(!in_array($result->name, $arr)){
        $output  = "<a href=\"test_description.php?subject=";
        $output .= urlencode($result->id);
        $output .= "\" "; 
        $output .= "style=\"margin-left: 60px;\" ";
        $output .= ">";
        $output .= htmlentities($result->name);
        $output .= "</a><br><br>";
        echo $output;
      }
   // }
  }else{
    echo "В данный момент доступных тестов нету.";
  }
?>

<?php include_layout_template('footer.php'); ?>
