<?php
require_once(LIB_PATH.DS.'database.php');

class Description_test_ind extends DatabaseObject {
	
	protected static $table_name="description_test_ind";
	protected static $db_fields = array('description', 'test_id');
	
	public $id;
	public $description;
	public $test_id;

	

	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }


  public static function find_by_test_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE test_id={$id} LIMIT 1");
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
	
	public function save($test_id){
	  return self::find_by_test_id($test_id) ? $this->update() : $this->create();
	  //return isset($this->test_id) ? $this->update() : $this->create();
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
		$sql .= " WHERE test_id={$this->test_id}";
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


}

?>