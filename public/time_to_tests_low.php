<?php require_once('../includes/initialize.php'); ?>
<?php
  $session->low_access_true();
	$current_page = $_GET['page'];
	$count_page = $session->count_page();
	if($current_page < $count_page || $current_page > $count_page){$session->low_access_false();}  
	if(!$session->access_permission()){redirect_to("started_test_page.php");}

	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = 1;
	$total_count = Tests::count_all();

	$pagination = new Pagination($page, $per_page, $total_count);
  
	$sql  = "SELECT * FROM tests ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$tests = Tests::find_by_sql($sql);

 ?>
	
 b  
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>
<?php $session->output_increase_num(); echo "<br>"; ?>
<?php echo $_SESSION['pass'] ? 'true' : 'false'; ?>
<?php foreach ($tests as $test): 	 
$test->form_for_test(); ?>	

<?php endforeach; ?>
<?php
	echo $current_page;
	echo $count_page;
	$check = isset($_POST['answer']) ? $_POST['answer'] : "" ;
  	if(empty($check)){

  	} else{
    	for($i=0; $i <1; $i++){
   		if($check[$i] == 1 && !empty($test->truth1)){
     		$session->increase();
     		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
      	} 
      	elseif($check[$i] == 2 && !empty($test->truth2)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
      	} 
      	elseif($check[$i] == 3 && !empty($test->truth3)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
      	}  
      	elseif($check[$i] == 4 && !empty($test->truth4)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
     	 }  
     	elseif($check[$i] == 5 && !empty($test->truth5)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
      	}	
      	elseif($check[$i] == 6 && !empty($test->truth6)){
      		$session->increase();
      		$session->num_page();
      		redirect_to("time_to_tests_low.php?page={$pagination->next_page()}");
      	} else{ 
      		$session->num_page();
			redirect_to("time_to_tests_low.php?page={$pagination->next_page()}"); 
		}   
    }
}

?>

<?php include_layout_template('footer.php'); ?>
