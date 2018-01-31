<?php
require_once(LIB_PATH.DS.'database.php');

class Tests extends DatabaseObject {
	
	protected static $table_name="tests";
	protected static $db_fields = array('question', 'subject_id', 'answer1','answer2', 'answer3', 'answer4', 'answer5', 'answer6', 'truth1', 'truth2', 'truth3', 'truth4', 'truth5', 'truth6', 'visible');
	
	public $id;
	public $question;
	public $subject_id;
	public $answer1;
	public $answer2;
	public $answer3;
	public $answer4;
	public $answer5;
	public $answer6;
	public $truth1;
	public $truth2;
	public $truth3;
	public $truth4;
	public $truth5;
	public $truth6;	
	public $visible;	
	

	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }


   public static function find_tests_for_subject($current_subject_id){
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE subject_id={$current_subject_id}");
   }


  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }


  public static function count_all($id){
  		global $database;
  		$sql  = "SELECT COUNT(*) FROM " .self::$table_name;
  		$sql .= " WHERE subject_id='{$id}'";
  		$result_set = $database->query($sql);
  		$row = $database->fetch_array($result_set);
  			return array_shift($row);
  	}

  	public static function counter_selected_tests($id){
  		global $database;
  		$sql  = "SELECT COUNT(*) FROM " .self::$table_name;
  		$sql .= " WHERE subject_id='{$id}'";
  		$sql .= " AND visible=1";
  		$result_set = $database->query($sql);
  		$row = $database->fetch_array($result_set);
  			return array_shift($row);
  	}


  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

	private static function instantiate($record) {
    $object = new self;
		 $object->id = $record['id'];
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update() {
	  global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=". $database->escape_value($this->id);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
		global $database;
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete_all_test_by_subject_id($subjec_id){
		global $database;
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE subject_id=". $database->escape_value($subjec_id);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}


	public function form_for_test(){
	
		echo "<form method=\"post\">";
		echo $this->question . "<br />";
	 	if(!empty($this->answer1)){
	 		echo "<input type=\"radio\" name=\"answer[]\" value=\"1\" >"; 
	  		echo $this->answer1;
	  		echo "<br />";
	  	}
		if(!empty($this->answer2)){
			echo "<input type=\"radio\" name=\"answer[]\" value=\"2\" >"; 
			echo $this->answer2;
			echo "<br />";
		}

		if(!empty($this->answer3)){
			echo "<input type=\"radio\" name=\"answer[]\" value=\"3\" >";
			echo $this->answer3; 
			echo "<br />";
		}

		if(!empty($this->answer4)){
			echo "<input type=\"radio\" name=\"answer[]\" value=\"4\" >";
			echo $this->answer4;
			echo "<br />";
		}

		if(!empty($this->answer5)){
			echo "<input type=\"radio\" name=\"answer[]\" value=\"5\" >";
			echo $this->answer5;
			echo "<br />";
		}

		if(!empty($this->answer6)){
			echo "<input type=\"radio\" name=\"answer[]\" value=\"6\" >";
			echo $this->answer6; 
		}
		echo "<br/><br/>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Готово\">";
		echo "</form>";
	
}

}

?>