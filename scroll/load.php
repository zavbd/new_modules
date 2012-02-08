<?php
mysql_connect('localhost', 'root', '') or die('could not connect with db');
mysql_select_db('db_test');
$limit = $_REQUEST['limit'];
$res = mysql_query('select * from users limit '.$limit);
while($row = mysql_fetch_assoc($res)){
	echo 'id:'.$row['id'].' name:'.$row['name'].' add:'.$row['add'].'<hr>';
}
?>
