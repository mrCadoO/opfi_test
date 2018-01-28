<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); 
  find_selected_test();

 $total_count = Tests::count_all($current_subject);
  if($_GET['page'] > $total_count){
    redirect_to("index.php");
  } 

 
  $user_id = $_SESSION['Id'];
  $student = Students::find_by_id($user_id);
  $student->assessment = $_SESSION['assessment'];
  $student->update_assessment($user_id);
  

  //PAGINATION
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = 1;
	$pagination = new Pagination($page, $per_page);
  $sql  = "SELECT * FROM tests ";
	$sql .= "WHERE subject_id='{$current_subject}' ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$tests = Tests::find_by_sql($sql);
  if($_SESSION['NumPage'] != $pagination->current_page){
    redirect_to("started_test_page.php");
  }
 ?>
	

<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>


<?php $session->output_increase_num(); echo "<br>"; 
 echo $session->num_page_out() . "<br>";
?>


<?php foreach ($tests as $test): 	 
$test->form_for_test(); ?>	
<?php endforeach; ?>


<?php
	$check = isset($_POST['answer']) ? $_POST['answer'] : "" ;
  	if(empty($check)){

  	} else{
    	for($i=0; $i <1; $i++){
   		if($check[$i] == 1 && !empty($test->truth1)){
     		$session->increase();
     		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
      	} 
      	elseif($check[$i] == 2 && !empty($test->truth2)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
      	} 
      	elseif($check[$i] == 3 && !empty($test->truth3)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
      	}  
      	elseif($check[$i] == 4 && !empty($test->truth4)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
     	 }  
     	elseif($check[$i] == 5 && !empty($test->truth5)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
      	}	
      	elseif($check[$i] == 6 && !empty($test->truth6)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}");
      	} else{ 
      		$session->num_page();
			redirect_to("time_to_tests.php?page={$pagination->next_page()}&subject={$test->subject_id}&user_id={$user_id}"); 
		}   
    }
}

?>

<?php include_layout_template('footer.php'); ?>
