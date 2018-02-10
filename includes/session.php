<?php

class Session{
	private $loged_in=false;
	private $logged_in_user=false;
	public $admin_id;
	public $user_id;
	public $message;
	


	function __construct(){
		session_start();
		$this->check_message();
		$this->check_login();
		$this->check_user_login();
		$this->loged_in;
		$this->logged_in_user;
		}



//////////////////////////// ADMIN AREA //////////////////////////////////

	public function is_loged_in(){
		return $this->loged_in;
	}


	public function login($admin){
		if($admin){
			$this->admin_id = $_SESSION['admin_id'] = $admin["id"];
			$this->loged_in = true;
		}
	}

	public function loguot(){
		unset($_SESSION['admin_id']);
		unset($this->admin_id);
		$this->loged_in = false;
	}

	private function check_login(){
		if(isset($_SESSION['admin_id'])){
			$this->admin_id = $_SESSION['admin_id'];
			$this->loged_in = true;
		} else {
			unset($this->admin_id);
			$this->loged_in = false;
		}
	}

//////////////////////////////////////////////////////////////////////////
	



//////////////////////////// USER AREA //////////////////////////////////

  public function confirm_logged_in(){
		return $this->logged_in_user;
	}


	public function login_user($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user["id"];
			$this->logged_in_user = true;
		}
	}


	private function check_user_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in_user = true;
		} else {
			unset($this->user_id);
			$this->logged_in_user = false;
		}
	}

	public function logged(){
		if(!$this->confirm_logged_in()){
			redirect_to("started_test_page.php");
		}
	}


//////////////////////////////////////////////////////////////////////////






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
		return $_SESSION['assessment']++;
	}

	
	public function output_increase_num(){
		if(!empty($_SESSION['assessment'])){
			echo $_SESSION['assessment'];
		} else {
			 echo 0;
		}
	}


	public function annulment(){
		$_SESSION['NumPage'] = 1;
		$_SESSION['assessment'] = 0;
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