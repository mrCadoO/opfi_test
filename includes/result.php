<?php
require_once(LIB_PATH.DS.'database.php');

class Result extends DatabaseObject {
	
	protected static $table_name="result";
	protected static $db_fields = array('first_name', 'last_name', 'group_name', 'assessment', 'test_name', 'now', 'end');
	
	public $id;
	public $first_name;
	public $last_name;
	public $group_name;
	public $assessment;
	public $test_name;
	public $now;
	public $end;
	

	// Common Database Methods
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
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

	public function update_assessment($id){
		global $database;
		$sql  = "UPDATE ".self::$table_name." SET assessment='{$this->assessment}'";
		$sql .= " WHERE id={$id}";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}

	public function update_test_name($user_id){
		global $database;
		$sql  = "UPDATE ".self::$table_name." SET test_name='{$this->test_name}'";
		$sql .= " WHERE id={$user_id}";
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


}

?>