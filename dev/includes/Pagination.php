<?php
class Pagination
{
	var $currentPage, $itemCount, $itemsPerPage, $linksHref, $linksToDisplay;
	var $pageJumpBack, $pageJumpNext, $pageSeparator;
	
	function __construct()
	{
		$this->currentPage = "";
		$this->itemCount = "";
		$this->itemsPerPage = "";
		$this->linksHref = "";
		$this->linksToDisplay = "";
		$this->pageJumpBack = "";
		$this->pageJumpNext = "";
		$this->pageSeparator = "";
	}

	function SetCurrentPage($reqCurrentPage){
    	$this->currentPage = (integer) abs($reqCurrentPage);
	}

    function SetItemCount($reqItemCount){
    	$this->itemCount = (integer) abs($reqItemCount);
    }

    function SetItemsPerPage($reqItemsPerPage){
        $this->itemsPerPage = (integer) abs($reqItemsPerPage);
    }

    function SetLinksHref($reqLinksHref){
        $this->linksHref = $reqLinksHref;
    }

    function SetLinksFormat($reqPageJumpBack, $reqPageSeparator, $reqPageJumpNext){
	    $this->pageJumpBack = $reqPageJumpBack;
	    $this->pageSeparator = $reqPageSeparator;
	    $this->pageJumpNext = $reqPageJumpNext;
    }

    function SetLinksToDisplay($reqLinksToDisplay){
    	$this->linksToDisplay  = (integer) abs($reqLinksToDisplay);
    }

    function SetQueryStringVar($reqQueryStringVar){
    	$this->queryStringVar = $reqQueryStringVar;
    }

   	function SetQueryString($reqQueryString){
    	$this->queryString = $reqQueryString;
    }
        
 
        
    function SetPGver($tmp){
    	$this->verpg= $tmp;
    }
        
    function GetCurrentCollection($reqCollection){
    	if($this->currentPage < 1){
        	$start = 0;
        }
      	elseif($this->currentPage > $this->GetPageCount()){
        	$start = $this->GetPageCount() * $this->itemsPerPage - $this->itemsPerPage;
        }else{
            $start = $this->currentPage * $this->itemsPerPage - $this->itemsPerPage;
            }  
        return array_slice($reqCollection, $start, $this->itemsPerPage);
    }

    function GetPageCount(){
    	return (integer)ceil($this->itemCount/$this->itemsPerPage);
    }

    function GetPageLinks(){
		$strLinks = '';

	 	$pageCount = $this->GetPageCount();
	  	$queryString = $this->GetQueryString();
	    $linksPad = floor($this->linksToDisplay/2);
		//$this->db_setters();
				
		if($this->linksToDisplay == -1){
	       	$this->linksToDisplay = $pageCount;
		}

		if($pageCount == 0){
			$strLinks = '1';
		}  elseif($this->currentPage - 1 <= $linksPad || ($pageCount - $this->linksToDisplay + 1 == 0)){ 
			$start = 1;
	     	}  elseif($pageCount - $this->currentPage <= $linksPad){
				$start = $pageCount - $this->linksToDisplay + 1;
			} else {
				$start = $this->currentPage - $linksPad;
				}


        if(isset($start)){
        	if($start > 1){
        		if(!empty($this->pageJumpBack)){
        			$pageNum = $start - $this->linksToDisplay + $linksPad;
        			if($pageNum < 1){
        				$pageNum = 1;
        	        }
        			$strLinks .= '<a href="'.$this->linksHref.$queryString.$pageNum.'">';
        			$strLinks .= $this->pageJumpBack.'</a>'.$this->pageSeparator;
        	    }
                  $strLinks .= '<a href="'.$this->linksHref.$queryString.'1">1...</a>'.$this->pageSeparator;
            }
         	if($start + $this->linksToDisplay > $pageCount){
          		$end = $pageCount;
        	}
        	else {
         		$end = $start + $this->linksToDisplay - 1;
        	}

        	for($i = $start; $i <= $end; $i ++){
        		if($i != $this->currentPage){
        			$strLinks .= '<a href="'.$this->linksHref.$queryString.($i).'">';
        			$strLinks .= ($i).'</a>'.$this->pageSeparator;
        		}
        		else {
        			if($this->verpg==2){
         				if($this->GetPageCount()> 1 ) {
          					$strLinks .= " [ <b>".$i.$this->pageSeparator."</b>] ";
          				} else{
          					$strLinks .= "  <b>".$i.$this->pageSeparator."</b> ";
          				}
          			} else{
          				$strLinks .= $i.$this->pageSeparator;
          			}
         		}
         	}
               
			$this->s_print ((eregi("page=".$this->queryStringVar.'.', $this->queryString)) ? $this->pg1 : '');
      		if($this->verpg!=2){
      			$strLinks = substr($strLinks, 0, -strlen($this->pageSeparator));
      		}

  			if($start + $this->linksToDisplay - 1 < $pageCount){
  				$strLinks .= $this->pageSeparator.'<a href="'.$this->linksHref.$queryString.$pageCount.'">';
   				$strLinks .= '...'.$pageCount.'</a>'.$this->pageSeparator;
                 
   				if(!empty($this->pageJumpNext)){
   	 				$pageNum = $start + $this->linksToDisplay + $linksPad;
     				if($pageNum > $pageCount){
      					$pageNum = $pageCount;
            		}
					$strLinks .= '<a href="'.$this->linksHref.$queryString.$pageNum.'">';
					$strLinks .= $this->pageJumpNext.'</a>';
 	             }
	        }
		}   
	return $strLinks;
   	}

    function GetQueryString(){
      	$pattern = array('/'.$this->queryStringVar.'=[^&]*&?/', '/&$/');
       	$replace = array('', '');
       	$queryString = preg_replace($pattern, $replace, $this->queryString);
       	$queryString = str_replace('&', '&amp;', $queryString);
        
       	if(!empty($queryString)){
        	$queryString.= '&amp;';
       	}
		return '?'.$queryString.$this->queryStringVar.'=';
   	}
 
   	function GetSqlLimit(){
       	$this->curPage =  (($this->currentPage * $this->itemsPerPage - $this->itemsPerPage)<0)?0:($this->currentPage * $this->itemsPerPage - $this->itemsPerPage);
       	return ' LIMIT '.$this->curPage.', '.$this->itemsPerPage;
   }

   function page_pagination($until_row,$total_result,$CurrentPage,$link_display,$ver=1){
   		$CurrentPage = ($CurrentPage=="" || $CurrentPage=="0") ? 1 : $CurrentPage;
   		$this->SetLinksFormat('&laquo; Back',' &bull; ','Next &raquo;');
   		$this->SetLinksHref($_SERVER['PHP_SELF']);
   		$this->SetQueryStringVar('page');
   		$this->SetQueryString($_SERVER['QUERY_STRING']);
   		
   		if(isset($_GET[$this->queryStringVar]) && is_numeric($_GET[$this->queryStringVar])){
   			$this->SetCurrentPage($_GET[$this->queryStringVar]);
   		} 
   		
   		$this->SetItemsPerPage($until_row);   // - set the number of item per page to display
   		$this->SetLinksToDisplay($link_display);   // - set the number of page links to display
   		$this->SetLinksFormat( " <<", " | ", ">> " );  // format
   		
   		$this->SetItemCount($total_result);
   		$this->SetCurrentPage($CurrentPage);
    
    	$begin_num = (0 >= ($until_row * $CurrentPage) - $until_row ) ? 1 : ($until_row * $CurrentPage - $until_row );
    	$until_num =  ($total_result < $until_row * $CurrentPage) ? $total_result : ($until_row * $CurrentPage);
           
        if($ver==1){
        	$this->SetLinksFormat( " <<", " | ", ">> " );  // format
        	$this->SetPGver(1);
        	
        	$tmpObj[] = "Displaying : $begin_num - $until_num of $total_result / Page ".$this->GetPageLinks();
        	$tmpObj[] = $this->GetSqlLimit();
        	$tmpObj[] = $begin_num;
        	$tmpObj[] = $until_num;
        } else{
        	$this->SetLinksFormat( " ", "  ", " " );  // format
        	$this->SetPGver(2);
        	
        	$tmpObj[] = $this->GetPageLinks();
        	$tmpObj[] = $this->GetSqlLimit();
        	$tmpObj[] = $begin_num;
        	$tmpObj[] = $until_num;

        }   
    return  $tmpObj;
  	}

	function s_print($str){
		print_r($str);
	}

        ## end pagin
}
?>