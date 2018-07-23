<?php
//Database connection constants

//C:\wamp64\www\gallery

defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
define('SITE_ROOT',DS.'wamp64'.DS.'www'.DS.'gallery');


defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH',SITE_ROOT.DS.'admin'.DS.'includes');



    
require_once("function.php");
require_once("new_config.php");
require_once("database.php");
require_once("db_object.php");
require_once("userclass.php");
require_once("photoclass.php");
require_once("imageclass.php");
require_once("commentclass.php");
require_once("paginateclass.php");
require_once("session.php");
