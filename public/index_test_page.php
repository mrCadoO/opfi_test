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



  $common_results = group_Subject::find_by_group_name($stud->group_name);
	$individual_results = selected_stud_Subject::find_by_user_id($stud->id);


  if($common_results){
    echo "<p>Задания для всей группы: </p>";
    foreach ($common_results as $common_result){
      if(!in_array($common_result->name, $arr)){
        $output  = "<a href=\"test_description.php?subject=";
        $output .= urlencode($common_result->id);
        $output .= "\" "; 
        $output .= "style=\"margin-left: 60px;\" ";
        $output .= ">";
        $output .= htmlentities($common_result->name);
        $output .= "</a><br><br>";
        echo $output;
      }
    }
  }else{
    echo "В данный момент доступных тестов нету.";
  }

  if($individual_results){
    echo "<p>Индивидуальные задания: </p>";
     foreach ($individual_results as $indiv_res){
      if(!in_array($indiv_res->name, $arr)){
        $output  = "<a href=\"test_description_ind.php?subject=";
        $output .= urlencode($indiv_res->id);
        $output .= "\" "; 
        $output .= "style=\"margin-left: 60px;\" ";
        $output .= ">";
        $output .= htmlentities($indiv_res->name);
        $output .= "</a><br><br>";
        echo $output;
      }
    }
  }

?>

<?php include_layout_template('footer.php'); ?>
