<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 

$subject = $_GET['subject'];
if(!$subject){
	redirect_to("manage_test.php");
}
$subj = new_Subject::find_by_id($subject);
	if(!$subj->id){
		redirect_to("manage_test.php");
	}


include_layout_template('admin_header.php'); ?>	
<a href="manage_test.php">&laquo; Назад</a> <br/><br/>	

<table>
<tr><th style="text-align: left; width: 600px;"><?php 
	$results = Subjects::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<h2>";
      $output .= htmlentities($result->name);
      $tests = Tests::find_tests_for_subject($result->id);
      foreach ($tests as $test):
        $output .= "</h2><ul><li>";
        $output .= "<a href=\"create_select_test.php?test=";
        $output .= urlencode($test->id);
        $output .= "&subject={$_GET['subject']}";
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul><br>";
      endforeach;
      $output .="</li><br>";
      echo $output;
    endforeach;
    echo "</ul>";
 ?></th>

<th><?php
	$output  = "<a href=\"delete_all_selected_test.php?id=";
	$output .= urlencode($subj->id);
	$output .= "\">";
	$output .= htmlentities($subj->name);
	$output .= "</a><br><br>";
	echo $output;
	$results = Select::find_by_subject_id($subject); 
	if(isset($results)){
		foreach($results as $result){
			$output  = "<a href=\"delete_selected_test.php?id=";
			$output .= urlencode($result->id);
			$output .= "\">";
			$output .= htmlentities($result->question);
			$output .= "</a><br>";
			echo $output;
		}
	}
?></th></tr>

</table>	
<?php include_layout_template('admin_footer.php'); ?>