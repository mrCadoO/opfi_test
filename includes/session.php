<?php

class Session{
	private $loged_in=false;
	public $user_id;
	public $message;
	public $number_of_correct_answers;
	public $id;




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
		return $_SESSION['assesment']++;
	}

	
	public function output_increase_num(){
		if(!empty($_SESSION['assesment'])){
			echo $_SESSION['assesment'];
		} else {
			 echo 0;
		}
	}


	public function annulment(){
		$_SESSION['NumPage'] = 1;
		$_SESSION['assesment'] = 0;
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

	public function num_page(){
		return $_SESSION['NumPage']++;
	}

	public function num_page_out(){
		if(isset($_SESSION['NumPage'])){
			echo $_SESSION['NumPage'];
		}
	}

}

$session = new Session();
$message = $session->message();


?>