<?php
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
?>
<!DOCTYPE html>

<html>

<!--
	This is a jQuery Tools standalone demo. Feel free to copy/paste.
	                                                         
	http://flowplayer.org/tools/demos/
	
	Do *not* reference CSS files and images from flowplayer.org when in production  

	Enjoy!
-->

<head>
	<title>jQuery Tools standalone demo</title>

	<!-- include the Tools -->
	<script src="jquery.tools.min.js"></script>
	<style type="text/css">
	#main{
		width:200px;
		height:200px;
		overflow:auto;
	}
	</style>
<script type="text/javascript">

$(document).ready(function(){
	
	$("#dont_show").hide();
	var total_rows = $("#dont_show").text();
	//alert($("#dont_show").text());
	var total_pages = Math.ceil(total_rows/5);
	//alert(total_pages);
	//return false;
	var rec_per_page = 5;
	var cur_page = 1;
	var page = cur_page - 1;
	var start = rec_per_page * page;
	var end = start + rec_per_page;
	$.fn.showFunction = function(start, end) {
		for(var i = 0; i < total_rows; i++)
		{
			if(i >= start && i < end)
				$('#hyouji_'+i).show();
			else $('#hyouji_'+i).hide();
		}
	}
	$.fn.showFunction(start, end);
	if(total_pages == 1)
	{
		$('#next').hide();
		$('#prev').hide();
	}
	$('#prev').hide();
	$('#next').click(function(){
		cur_page++;
		alert('cur_page:'+cur_page);
		page = cur_page - 1;
		
		start = rec_per_page * page;
		end = start + rec_per_page;
		start = rec_per_page * page;
		end = start + rec_per_page;
		if(cur_page <= total_pages)
		{
			$.fn.showFunction(start, end);
			if(cur_page == total_pages)$('#next').hide();
			$('#prev').show();
		}
		else
		{
			$('#next').hide();
			cur_page--;
			$('#prev').show();
		}
			/*alert('cur page is:'+cur_page+':total pages:'+total_pages+':no more page!');*/
		
		//$.fn.myFunction(7);
		return false;
	});
	$('#prev').click(function(){
		
		cur_page--;
		page = cur_page - 1;
		
		start = rec_per_page * page;
		end = start + rec_per_page;
		start = rec_per_page * page;
		end = start + rec_per_page;
		alert('cur_page:'+cur_page+':start:'+start+':end:'+end);
		if(cur_page <= total_pages && cur_page > 1)
		{
			$.fn.showFunction(start, end);
			$('#next').show();
		}
		else
		{
			$('#prev').hide();
			$('#next').show();
		}
			/*alert('cur page is:'+cur_page+':total pages:'+total_pages+':no more page!');*/
		
		//$.fn.myFunction(7);
		return false;
	});
	
	/*$("#main").load('load.php', {limit: 5});
	$('#next').click(function(){
		alert('next has pressed');
		$.fn.myFunction(7);
		return false;
	});
	$('#prev').click(function(){
		alert('prev has pressed');
		$.fn.myFunction(10);
		return false;
	});
	
	 $.fn.myFunction = function(limit_) {
	 alert(limit_);
	 $("#main").load('load.php', {limit: limit_, page : 2});
	 } */
} 
);
</script>
</head>

<body>
<a href="" id="prev">prev>></a>
<div id="main">
<span id="dont_show"><?php echo count($arrData);?></span>
<?php
$sl_no = 0;
foreach($arrData as $key=>$value)
{
?>
<span id="hyouji_<?php echo $sl_no;?>">
<?php
var_dump($value);
echo '<hr>';
?>
</span>
<?php
	
	$sl_no++;
}
?>
</div>
<a href="" id="next">next>></a>
</body>

</html>