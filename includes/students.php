<?php
require_once(LIB_PATH.DS.'database.php');

class Student extends DatabaseObject {
	
	protected static $table_name="students";
	protected static $db_fields = array('first_name', 'last_name', 'group_name', 'login', 'hashed_password');
	
	public $id;
	public $first_name;
	public $last_name;
	public $group_name;
	public $login;
	public $hashed_password;

	
	public static function authenticate($login) { 
		global $database;
		$safe_username = $database->escape_value($login);
		$sql  = "SELECT * FROM ".self::$table_name;
		$sql .= " WHERE login = '{$safe_username}'";
		$sql .= " LIMIT 1";
		$user_set = $database->query($sql);
		if($user = mysqli_fetch_assoc($user_set)){
			return $user;
		} else {
			return null;
		}	  
	}

	public static function attempt_login($login, $password) {
     	$user = self::authenticate($login);
     	if($user){
      		if(password_check($password, $user["hashed_password"])){
       			return $user;
      		}else {
       			return false;
      		}
      	}else {
        	return false;
      	}
   }

    public function full_name() {
    	if(isset($this->first_name) && isset($this->last_name)) {
   		return $this->first_name . " " . $this->last_name;
    	} else {
      		return "";
    	}
  }

	
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


	
}

?>