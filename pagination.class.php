<?php
/*
Author : Sunil Bhatt
*/
class sbpagination
{
	public $perpage;
	function __construct()
	{
		$this->perpage = 10;
	}

	function getAllPageLinks($url,$count,$page,$liclass,$aclass)
	{
		$output = '';
		if(!isset($page)) $page = 1;
		if($this->perpage != 0)
			$pages  = ceil($count/$this->perpage);
		if($pages>1) {
			if($page == 1) 
				$output = $output . '<li class="'.$liclass.' disabled"><a href="javascript:void(0);" class="'.$aclass.' first disabled">&#8810;</a></li><li class="'.$liclass.' disabled"><a href="javascript:void(0);" class="'.$aclass.' disabled">&#60;</span></li>';
			else	
				$output = $output . '<li class="'.$liclass.'"><a href="'.$url.'" class="'.$aclass.' first" >&#8810;</a></li><li class="'.$liclass.'"><a href="'.$url.'?page='.($page-1).'" class="'.$aclass.'" >&#60;</a></li>';
			
			if ($page<4)
			{
				$start 	= 1;
				$end 	= 5;
			}
			else
			{
				$start 	= ($page-2);
				$end 	= ($page+2);
			}
			
			$endpage = ($pages-3);
			if ($page>$endpage)
			{
				$start 	= ($pages-4);
			}

			for($i=$start; $i<=$end; $i++)	
			{
				if($i<1) continue;
				if($i>$pages) break;
				if($page == $i)
				{
					$output = $output . '<li class="'.$liclass.' active"><a href="javascript:void(0);" class="'.$aclass.' current">'.$i.'</a></li>';
				}
				else
				{				
					$output = $output . '<li class="'.$liclass.'"><a href="'.$url.'?page='.$i.'" class="'.$aclass.'" >'.$i.'</a></li>';
				}
			}
			
			if($page < $pages)
				$output = $output . '<li class="'.$liclass.'"><a href="'.$url.'?page='.($page+1).'" class="'.$aclass.'" >></a></li><li class="'.$liclass.'"><a href="'.$url.'?page='.$pages.'" class="'.$aclass.'" >&#8811;</a>';
			else				
				$output = $output . '<li class="'.$liclass.' disabled"><a href="javascript:void(0);" class="'.$aclass.' disabled">></a></li><li class="'.$liclass.' disabled"><a href="javascript:void(0);" class="'.$aclass.' disabled">&#8811;</a></li>';
			
		}
		return $output;
	}
}
?>