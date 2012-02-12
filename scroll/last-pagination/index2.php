<?php
session_start();
ob_start();

//require "../config.php";
mysql_connect('localhost', 'root', '') or die('could not connect with db');
mysql_select_db('db_test');
require "class.pagination2.php";

/*** Variables ***/
$page = 1; //default page
$per_page = 2; //rows per page
$full_sql = "select * from course order by course_name"; //full sql before split in to pages
$display_links = 20; //number of links to be displayed - odd number
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

//get the links and store it in a variable
$page_links = $pageObj->get_links($display_links);
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<title>PHP Pagination Class 2</title>
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
				<?php echo $page_links; ?>
			</td>
		</tr>
	</table>
</div>
<div align="center"><a href="http://www.beski.wordpress.com">http://www.beski.wordpress.com</a></div>
</body>
</html>