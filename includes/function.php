<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if(!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return ""; 
  }
}


function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

  function datetime_to_text($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d %Y at %I:%M %p", $unixdatetime);
  }

  function find_selected_test(){
    global $current_subject;
    global $current_test;

    if(isset($_GET['subject'])){
      $current_subject = $_GET['subject'];
    }
    if(isset($_GET['test'])){
      $current_test = $_GET['test'];
    }
  }

   function admin_test(){
    $results = Subjects::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<a href=\"list_tests.php?subject=";
      $output .= urlencode($result->id);
      $output .= "\"> ";
      $output .= htmlentities($result->name);
      $output .= "</a>";
      $tests = Tests::find_tests_for_subject($result->id);
      foreach ($tests as $test):
        $output .= "<ul><li>";
        $output .= "<a href=\"current_question.php?test=";
        $output .= urlencode($test->id);
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul>";
      endforeach;
      $output .="</li>";
      echo $output;
    endforeach;
    echo "</ul>";

  }

?>