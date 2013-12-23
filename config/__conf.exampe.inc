<?php

$db_usr = "";
$db_pwd = "";
$db_host = "localhost";
$db_db = "archery"

$db_conn = new mysqli($db_host, $db_usr, $db_pwd, $db_db);

if(!isset($db_conn)){
    exit("DB Connection failed");
}
$baselink = "/archery/";

