<?php
session_start();
ob_start();

require "../config.php";
require "class.pagination1.php";

/*** Variables ***/
//default page
$page = 1; 

//rows per page
$per_page = 10; 

//full sql before split in to pages
$full_sql = "select * from course order by course_name"; 
/*** Variables ***/

//check page number
if(isset($_REQUEST['page']))
	$page = $_REQUEST['page'];

//create object, pass the values
$pageObj = new pagination($full_sql, $per_page, $page);

//sql after getting split in to pages
$sql = $pageObj->get_query();
$rsd = mysql_query($sql);

//starting serial number
$sl_start = $pageObj->offset;
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<title>PHP Pagination Class 1</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div align="center">
	<table border="0" cellpadding="0" cellspacing="0" width="800">
		<tr>
			<td><b>Course List</b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<div align="center">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="78">SL. No</td>
						<td>Course Name</td>
					</tr>
					<tr>
						<td width="78">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?php
						while($rs = mysql_fetch_array($rsd))
						{
					?>
					<tr>
						<td width="78"><?php echo ++$sl_start; ?>&nbsp;</td>
						<td><?php echo $rs['course_name']; ?></td>
					</tr>
					<?php
						}
					?>
				</table>
			</div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<?php echo $pageObj->get_links(); ?>
			</td>
		</tr>
	</table>
</div>
<div align="center"><a href="http://www.beski.wordpress.com">http://www.beski.wordpress.com</a></div>
</body>
</html>