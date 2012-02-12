<?php
/***** http://beski.wordpress.com ******/
/* Version 1: showign all pages */
class pagination {
	var $full_sql, $per_page, $cur_page, $tot_pages, $offset;
	
	function pagination($full_sql, $per_page, $cur_page) {
		$this->full_sql = $full_sql;
		$this->per_page = $per_page;
		$this->cur_page = $cur_page;
		
		$sqlt = $full_sql;
		$rsdt = mysql_query($sqlt);
		$total = mysql_num_rows($rsdt);
		$this->tot_pages = ceil($total/$per_page);
	}
	
	function get_query() {
		$this->offset = ($this->cur_page - 1) * $this->per_page;
		return $this->full_sql." limit $this->offset,$this->per_page";
	}
	
	function get_links() {
		$page_link = "<div id='pages'>";
				
		//previous link - if current page is first page: no link
		if ($this->cur_page > 1) {
			$prev  = $this->cur_page - 1;
			$page_link .= " <a href='$self?page=$prev'>[Prev]</a> ";
		}
		else {
			$page_link .= "<span>[Prev] </span>";
		}
		
		//page links with number - current page number: no link
		for($i = 1; $i <= $this->tot_pages; $i++) {
			if ($i == $this->cur_page)
				$page_link .= " $i ";
			else
				$page_link .= " <a href=\"$self?page=$i\">$i</a> ";
		}
		
		//next link - if current page is last page: no link
		if ($this->cur_page < $this->tot_pages) {
			$next = $this->cur_page + 1;
			$page_link .= " <a href='$self?page=$next'>[Next]</a> ";
		}
		else {
			$page_link .= "<span> [Next]</span>";
		}
		$page_link .= "</div>";
		return $page_link;
	}
}
?>
