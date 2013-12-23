<?php
    @require_once('config/__conf.inc');
    $aResult = array();
    $selectQuery = "SELECT left(time,10) AS time, sum(points) AS arrowcount, count(points) as shootcount FROM hits GROUP BY left(time, 10) ORDER BY left(time,10) DESC LIMIT 10;";
	
    $result = $db_conn->query($selectQuery);

    while($row=$result->fetch_assoc()){
        $aResult[date('d.m.Y', strtotime($row['time']))] = array('points'=> $row['arrowcount'], 'arrows' => $row['shootcount']);
    }
    
    echo JSON_ENCODE($aResult, JSON_FORCE_OBJECT);

?>
