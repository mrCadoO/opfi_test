<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :
 define('SITE_ROOT', 
 	DS. 'wamp64'.DS.'www'.DS.'opfi_test');

 defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');


require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'function.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');

// load core classes
require_once(LIB_PATH.DS.'admin.php');
require_once(LIB_PATH.DS.'students.php');
require_once(LIB_PATH.DS.'subject.php');
require_once(LIB_PATH.DS.'test.php');
require_once(LIB_PATH.DS.'result.php');
require_once(LIB_PATH.DS.'pagination.php');
require_once(LIB_PATH.DS.'description.php');
require_once(LIB_PATH.DS.'group.php');
require_once(LIB_PATH.DS.'group_test.php');
require_once(LIB_PATH.DS.'group_subject.php');


?>