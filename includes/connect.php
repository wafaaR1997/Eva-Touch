<?php
/**
 * include configuration constants
 */
 
if(defined("LOCAL_ENV"))
{
   include_once "config/local_database.php";
}else
{
	 //die("1111");
    include "config/local_database.php";
}
/**
 * Invoke database controller
 */
include_once "Utils/DB.php";

/**
 * Instantiate global database controller object
 */
global $db;
$db = new DB(DB_HOST, DB_USER, DB_PASS, DB_NAME);