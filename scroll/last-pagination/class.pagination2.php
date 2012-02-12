<?php
/***** http://beski.wordpress.com ******/
/* Version 2: show some number of page links */
class pagination {
	var $full_sql, $per_page, $cur_page, $tot_pages, $offset;
	
	function pagination($full_sql, $per_page, $cur_page) {
		$this->full_sql = $full_sql;
		$this->per_page = $per_page;
		$this->cur_page = $cur_page;
		
		$sqlt = $full_sql;
		$rsdt = mysql_query($sqlt);
		$total = mysql_num_rows($rsdt);
		//$this->tot_pages = ceil($total/$per_page);
		$this->tot_pages = 130;
	}
	
	function get_query() {
		$this->offset = ($this->cur_page - 1) * $this->per_page;
		return $this->full_sql." limit $this->offset,$this->per_page";
	}
	
	function get_links($display=10) {
		$page_link = "<div id='pages'>";
		//if display is not odd make it odd
		if(!$display&1)
			$display++;
		
		//previous link - if current page is first page: no link
		/*if ($this->cur_page > 1) {
			$prev  = $this->cur_page - 1;
			$page_link .= " <a href='?page=$prev'>[Prev]</a> ";
		}
		else {
			$page_link .= "<span>[Prev] </span>";
		}*/
		
		//define the starting page no link and end
		$side_display = floor($display/2);
		$start = 1;
		$end = $this->tot_pages;
		if($this->tot_pages > $display)
		{
			if($this->cur_page > $side_display)
				$start = $this->cur_page - $side_display;
			else
				$end = $display;
			
			if(($this->cur_page + $side_display) < $this->tot_pages)
			{
				if($this->cur_page > $side_display)
					$end = $this->cur_page + $side_display;
			}
			else
				$start = ($this->tot_pages - $display) + 1;
		}
			
		//page links with number - current page number: no link
		for($i = $start; $i <= $end; $i++) {
			if ($i == $this->cur_page)
				$page_link .= " $i ";
			else
				$page_link .= " <a href=\"?page=$i\">$i</a> ";
		}
		
		//next link - if current page is last page: no link
		/*if ($this->cur_page < $this->tot_pages) {
			$next = $this->cur_page + 1;
			$page_link .= " <a href='?page=$next'>[Next]</a> ";
		}
		else {
			$page_link .= "<span> [Next]</span>";
		}*/
		$page_link .= "</div>";
		return $page_link;
	}
}
?>
