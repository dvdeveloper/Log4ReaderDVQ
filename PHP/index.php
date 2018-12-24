<?php
include "CreateLog.php";

$obj = new CreateLog();
$obj->action = $_SERVER['REQUEST_URI'];
$obj->title = "test php";
$obj->type = "GET/ ".$_SERVER['REQUEST_URI'];
$obj->message = "test";
$obj->parameters = $_SERVER['QUERY_STRING'];
$obj->users = "root";
$obj->IP = $_SERVER['REMOTE_ADDR'];
$obj->origen = $_SERVER['HTTP_USER_AGENT'];

echo $obj->save();