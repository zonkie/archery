<?php
ini_set('display_errors', 'on');
require_once("config/__conf.inc");
$result = '';
$points = $_POST['hit'];
if(isset($points)){
    $db_conn->query("INSERT INTO hits VALUES(now(),". $points ." );");
    $result = "Hit:". $_POST['hit'] ." points";
} else {
    $result = "error saving";
}

echo json_encode(array('result'=>$result), JSON_FORCE_OBJECT);

