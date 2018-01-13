<?php

class Session{
	private $loged_in=false;
	public $user_id;
	public $message;
	public $number_of_correct_answers;




	function __construct(){
		session_start();
		$this->check_message();
		$this->check_login();
		if($this->loged_in){
			//in next time
		} else{

		}
		}

	public function is_loged_in(){
		return $this->loged_in;
	}


	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->loged_in = true;
		}
	}

	private function check_message(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}

	public function message($msg=""){
		if(!empty($msg)){
			$_SESSION['message'] = $msg;
		} else {
			return $this->message;
		}
	}

	public function increase(){
		return $_SESSION['number_of_correct_answers']++;
	}

	
	public function output_increase_num(){
		if(!empty($_SESSION['number_of_correct_answers'])){
			echo $_SESSION['number_of_correct_answers'];
		} else {
			 echo 0;
		}
	}


	public function annulment(){
		$_SESSION['NumPage'] = 1;
		$_SESSION['number_of_correct_answers'] = 0;
	}


	public function loguot(){
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->loged_in = false;
	}

	private function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->loged_in = true;
		} else {
			unset($this->user_id);
			$this->loged_in = false;
		}
	}

	public function access_true(){
		return $_SESSION['pass'] = true;
	}

	public function access_false(){
		return $_SESSION['pass'] = false;
	}

	public function access_permission(){
		return $_SESSION['pass'];
	}

	public function num_page(){
	
		return $_SESSION['NumPage']++;
	}

	public function count_page(){
		return $_SESSION['NumPage'];
	}

	public function low_access_true(){
		$_SESSION['accessLOW'] = true;
	}

	public function low_access_false(){
		$_SESSION['accessLOW'] = false;
	}

	public function is_low_access(){
		return $_SESSION['accessLOW'];
	}





}

$session = new Session();
$message = $session->message();


?>