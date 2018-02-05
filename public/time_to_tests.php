<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>
<?php  find_selected_test(); ?>
<?php

  //end of test
  $total_count = Select::count_all($current_subject);
  if($_GET['page'] > $total_count){
    redirect_to("index.php");
  } 


  //validation of subject id
  if(isset($_SESSION['get_data'])){
    if($_SESSION['get_data'] != $_GET['subject']){
      $_SESSION['get_data'] = null;
      $_SESSION['user_login'] = null;
      redirect_to("index.php");
    }
  }
  $_SESSION['get_data'] = null;


  //update assessment (db)
  $user_id = $_SESSION['Id'];
  $student = Students::find_by_id($user_id);
  $student->assessment = $_SESSION['assessment'];
  $student->update_assessment($user_id);


  //PAGINATION
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = 1;
	$pagination = new Pagination($page, $per_page);
  $sql  = "SELECT * FROM selected_test ";
	$sql .= "WHERE subject_id='{$current_subject}' ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$tests = Select::find_by_sql($sql);


  //validation of page number
  if($_SESSION['NumPage'] != $pagination->current_page){
    redirect_to("started_test_page.php");
  }
?>
	

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>
<?php echo $session->output_increase_num(); ?>

<form method="POST">
<?php

  foreach ($tests as $test){
    $output  = htmlentities($test->question);
    $output .= "<br />";
    if(!empty($test->answer1)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"1\" >"; 
      $output .= htmlentities($test->answer1);
      $output .= "<br />";
    }
    if(!empty($test->answer2)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"2\" >"; 
      $output .= htmlentities($test->answer2);
      $output .= "<br />";
    }
    if(!empty($test->answer3)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"3\" >";
      $output .= htmlentities($test->answer3); 
      $output .= "<br />";
    }
    if(!empty($test->answer4)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"4\" >";
      $output .= htmlentities($test->answer4);
      $output .= "<br />";
    }
    if(!empty($test->answer5)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"5\" >";
      $output .= htmlentities($test->answer5);
      $output .= "<br />";
    }
    if(!empty($test->answer6)){
      $output .= "<input type=\"radio\" name=\"answer\" value=\"6\" >";
      $output .= htmlentities($test->answer6); 
    }
    $output .= "<br/><br/>";
    $output .= "<input type=\"submit\" name=\"submit\" value=\"Готово\">";  
}
  echo $output;  ?>

</form>


<?php
  //user answer
  $check = isset($_POST['answer']) ? $_POST['answer'] : "" ;

  //check the correct answer
  switch(true){  
    case($check == 1 && !empty($test->truth1)) :
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}"); 
               
    case($check == 2 && !empty($test->truth2)) :
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}");             

    case($check == 3 && !empty($test->truth3)):
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}"); 
               
    case($check == 4 && !empty($test->truth4)) :
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}"); 
               
    case($check == 5 && !empty($test->truth6)) :
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}"); 
            
    case($check == 6 && !empty($test->truth6)) :
      $session->increase();
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}"); 
              
    case($check) : 
      $session->num_page();
      redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}");
               
    }
?>
<?php include_layout_template('footer.php'); ?>


