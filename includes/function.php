<?php

function strip_zeros_from_date($marked_string="") {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to($location = NULL) {
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

  
  function password_encrypt($password) {
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password, $format_and_salt);
    return $hash;
    }
    
    

    function generate_salt($length){
      $unique_random_string = md5(uniqid(mt_rand(), true));
      $base64_string = base64_encode($unique_random_string);
      $modified_base64_string = str_replace('+', '.', $base64_string);
      $salt = substr($modified_base64_string, 0, $length);
      return $salt;
    }
    
    
    function password_check($password, $existing_password){
      $hash = crypt($password, $existing_password);
      if ($hash === $existing_password) {
      return true;
    } else {
      return false;
    }
   } 

  
  
  function logged_in() {
  return isset($_SESSION['user_login']);
  }
  
  
  function confirm_logged_in() {
    if (!logged_in()){
  redirect_to("started_test_page.php");
}
}

?>