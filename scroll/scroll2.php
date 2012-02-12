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
		width:300px;
		height:200px;
		/*overflow:auto;*/
	}
	</style>
<script type="text/javascript">

$(document).ready(function(){
	var select_id = '<?php if(isset($_GET['selid'])) echo $_GET['selid'];?>';
	var clost = $("#"+select_id).closest("span").attr('id'); 
	var pattern1 = /hyouji_(\d+).*/;
	var match = [];
	var match_test = pattern1.exec(clost);
	
	if(match_test == null)
	{
		match.push(0);
		match.push(1);
	}
	else
	 match = match_test;
	//alert(match);
	$("#dont_show").hide();
	var total_rows = $("#dont_show").text();
	$.fn.pagingFunction = function(page_num) {
		var arr = [];
		var display = 20; // how many boxes
		/*if(!display&1)
			display++;*/
	
		var tot_pages = total_rows;
		var side_display = Math.floor(display/2);
		var start = 0;
		var end = 0;
		
		start = 1;
		end = total_rows;
		
		if(tot_pages > display)
		{
			if(page_num > side_display)
				start = parseInt(page_num) - side_display;
			else
				end = display;
			
			if((parseInt(page_num) + side_display) < tot_pages)
			{
				//alert('here1'+' pagenum:'+page_num+' side disp:'+side_display);
				if(page_num > side_display)
					end = parseInt(page_num) + side_display -1;
			}
			else
			{
				
				//alert('here2');
				start = (tot_pages - display) + 1;
			}
		}
		arr.push(start);
		arr.push(end);
		return arr;
		
	}
	var page_num = match[1];

	var arr = $.fn.pagingFunction(page_num);
	/*$.each(arr, function(i, v) {
		//alert('display id:'+v);
	});*/
	for(var i = 1; i <= total_rows; i++)
	{
		//if(i >= start && i <= end)
			$('#hyouji_'+i).hide();
		//else $('#hyouji_'+i).hide();
	}
	$.fn.showFunction = function(start, end, total_rows) {
		//alert('start:'+start+' end:'+end);
		for(var i = start; i <= end; i++)
		{
			//if(i >= start && i <= end)
				$('#hyouji_'+i).show();
			//else $('#hyouji_'+i).hide();
		}
	}
	//$.fn.showFunction(arr[0], arr[1], total_rows);
	start = arr[0];
	end = arr[1];
	$.fn.showFunction(start, start + 5, total_rows);
	var total_rows_sub = (end - start) + 1;
	//alert($("#dont_show").text());
	var total_pages = Math.ceil(total_rows_sub/5);
	//alert(total_pages);
	//return false;
	var rec_per_page = 5;
	var cur_page = 1;
	var page = 0;
	var start_sub = 0;
	var end_sub = 0;
	
	if(total_pages == 1)
	{
		$('#next').hide();
		$('#prev').hide();
	}
	$('#prev').hide();
	$('#next').click(function(){
		cur_page++;
		//alert('cur_page:'+cur_page);
		page = cur_page - 1;
		
		start_sub = start + (rec_per_page * page);
		
		end_sub = start_sub + rec_per_page;
		if(end_sub > end)
			end_sub = end;
		//start = rec_per_page * page;
		//end = start + rec_per_page;
		if(cur_page <= total_pages)
		{
			$.fn.showFunction(start_sub, end_sub, total_rows_sub);
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
	$.fn.hideFunction = function(start, end) {
		//alert('start:'+start+' end:'+end);
		for(var i = start; i <= end; i++)
		{
			//if(i >= start && i <= end)
				$('#hyouji_'+i).hide();
			//else $('#hyouji_'+i).hide();
		}
	}
	$('#prev').click(function(){
		
		
		cur_page--;
		page = cur_page - 1;
		alert(end+'::'+cur_page+'::'+page);return false;
		
		start_sub = end - (rec_per_page * page);
		
		end_sub = start_sub + rec_per_page;
		alert(start_sub+'::'+end_sub);return false;
		//start = rec_per_page * page;
		//end = start + rec_per_page;
		//alert('cur_page:'+cur_page+':start:'+start+':end:'+end);
		if(cur_page <= total_pages && cur_page > 1)
		{
			$.fn.hideFunction(start_sub, end_sub);
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
	return false;
} 
);
</script>
</head>

<body>
<a href="" id="prev">prev>></a>
<hr>
<a href="" id="next">next>></a>
<hr>
<?php
if(isset($_GET['selid']))
{
	echo 'clicked id is:'.$_GET['selid'];
}
?>
<div id="main">
<span id="dont_show"><?php echo count($arrData);?></span>
<?php
$sl_no = 1;
foreach($arrData as $key=>$value)
{
?>
<span id="hyouji_<?php echo $sl_no;?>">
<a href="?selid=<?php echo $key;?>" id="<?php echo $key;?>"><?php echo $sl_no.'::'.$key;?></a>
<?php
//var_dump($value);
echo ' name:'.$value['name'].' add:'.$value['add'];
echo '<hr>';
?>
</span>
<?php
	
	$sl_no++;
}
?>
</div>

</body>

</html>