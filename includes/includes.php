<?php

    @session_start();



define("DEBUG",true);


if (strpos($_SERVER['SERVER_ADDR'], "127.0.0") !== false)
{
	define("LOCAL_ENV", true);
}


ini_set('display_errors', '0');

ini_set('max_execution_time', 600);

ini_set('memory_limit', '600M');
require_once "connect.php"; // config.php is included here .

include "common.php";
