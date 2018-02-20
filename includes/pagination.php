<?php
	class Pagination{
		public $current_page;



		public function __construct($page=1){
			$this->current_page = (int)$page;
		}



		public function offset(){
			return ($this->current_page) - 1;
		}


		public function previous_page(){
			return $this->current_page - 1;
		}

		public function next_page(){
			return $this->current_page +1;
		}


		public function has_previous_page(){
			return $this->previous_page() >=1 ? true : false;
		}


		public function has_next_page(){
			return $this->next_page() <=$this->total_pages() ? true : false;
		}




	}





?>