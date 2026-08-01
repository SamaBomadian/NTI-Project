<?php


session_start();

session_unset();
session_destroy();

header("location:/nti-project(2)/index.php");
exit();