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
	$("#main").load('load.php', {limit: 5});
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
	 } 
} 
);
</script>
</head>

<body>
<a href="" id="prev">prev>></a>
<div id="main">
</div>
<a href="" id="next">next>></a>
</body>

</html>