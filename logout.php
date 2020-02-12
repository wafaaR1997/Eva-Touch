<?php
include "includes/includes.php";
//todo: unset sessions .
session_destroy();
redirect("login.php",1);
exit;
