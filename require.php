<?php
session_start();
require_once('inc/pdo.php');
require_once('inc/validate.php');
include_once('inc/get.inc.php');
$alert = NULL;
include_once('forms/functions.php');
include_once('inc/effects.js');
include_once('inc/effects.css');
getHead();
?>
