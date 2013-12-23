<?php
ini_set('display_errors', 'on');
require_once("config/__conf.inc");

if(isset($_POST['action'])){
	switch ($_POST['action']){
 		case 'passe3':
			echo "3 arrows shot (6m)";
			$db_conn->query("INSERT INTO count VALUES(now(),3);");
			break;
		default:
			echo "nothing inserted";
			break;
	}
}


?>
<form name="shoot" method="post">
Passe geschossen:
	<input type="hidden" name="action" value="passe3"/>
	<input type="submit" name="3" value="3 arrows"/>
</form>


<?php
$selectQuery = "SELECT left(time,10) AS time, sum(arrowcount) AS arrowcount FROM count GROUP BY left(time, 10);";

$result = $db_conn->query($selectQuery);

while($row=$result->fetch_assoc()){
    echo date('d.m.Y', strtotime($row['time'])) .': '. $row['arrowcount'].'<br />';
}



?>
