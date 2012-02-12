<?php
require_once('paginator.class.php');
mysql_connect('localhost', 'root', '') or die('could not connect with db');
mysql_select_db('db_test');
//$limit = $_REQUEST['limit'];
$res = mysql_query('select * from users');
$arrData = array();
$arrChild = array();

$sl_no = 1;
while($row = mysql_fetch_assoc($res)){
	//echo 'id:'.$row['id'].' name:'.$row['name'].' add:'.$row['add'].'<hr>';
	$arrData[$row['id']] = array('name' => $row['name'], 'add' => $row['add']);
}
$arrChild['114']['900'] = array('name' => 'ali1', 'add' => 'aa900');
$arrChild['114']['901'] = array('name' => 'ali901', 'add' => 'aa901');
$arrChild['114']['902'] = array('name' => 'ali902', 'add' => 'aa902');
$arrChild['114']['903'] = array('name' => 'ali903', 'add' => 'aa903');

$arrChild['151']['800'] = array('name' => 'ali800', 'add' => 'aa800');
$arrChild['151']['801'] = array('name' => 'ali801', 'add' => 'aa801');
$arrChild['151']['802'] = array('name' => 'ali802', 'add' => 'aa802');
$arrChild['151']['803'] = array('name' => 'ali803', 'add' => 'aa803');
//print_r($arrData);

//print_r($arrChild);
//exit;
$pages = new Paginator;
$pages->items_total = 130;
$pages->mid_range = 20;
$pages->paginate();
echo $pages->display_pages();
?>