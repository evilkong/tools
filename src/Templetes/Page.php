<?php
namespace U0mo5\Tools\Templetes;
class Zend_Page{ 
     
   private  $each_disNums;//每页显示的条目数 
   private  $nums;//总条目数 
   private  $current_page;//当前被选中的页 
   private  $sub_pages;//每次显示的页数 
   private  $pageNums;//总页数 
   private  $page_array = array();//用来构造分页的数组 
   private  $subPage_link;//每个分页的链接 
   private  $subPage_type;//显示分页的类型 
   private  $myShowPage;
   /*
   __construct是SubPages的构造函数，用来在创建类的时候自动运行.
   @$each_disNums   每页显示的条目数
   @nums     总条目数
   @current_num     当前被选中的页
   @sub_pages       每次显示的页数
   @subPage_link    每个分页的链接
   @subPage_type    显示分页的类型
    
   当@subPage_type=1的时候为普通分页模式
         example：   共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
         当@subPage_type=2的时候为经典分页样式
         example：   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
   */ 
  function __construct($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type){ 
   $this->each_disNums=intval($each_disNums); 
   $this->nums=intval($nums); 
    if(!$current_page){ 
    $this->current_page=1; 
    }else{ 
    $this->current_page=intval($current_page); 
    } 
   $this->sub_pages=intval($sub_pages); 
   $this->pageNums=ceil($nums/$each_disNums); 
   $this->subPage_link=$subPage_link;  
   $this->myShowPage = $this->show_SubPages($subPage_type);  
   //echo $this->pageNums."--".$this->sub_pages; 
  } 
   //显示页数
   function pageShow(){
    return $this->myShowPage;
   }  
     
  /*
    __destruct析构函数，当类不在使用的时候调用，该函数用来释放资源。
   */ 
  function __destruct(){ 
    unset($each_disNums); 
    unset($nums); 
    unset($current_page); 
    unset($sub_pages); 
    unset($pageNums); 
    unset($page_array); 
    unset($subPage_link); 
    unset($subPage_type); 
   } 
     
  /*
    show_SubPages函数用在构造函数里面。而且用来判断显示什么样子的分页  
   */ 
  function show_SubPages($subPage_type){ 
    if($subPage_type == 1){ 
    	return $this->subPageCss1(); 
    }elseif ($subPage_type == 2){ 
    	return $this->subPageCss2(); 
    }elseif ($subPage_type == 3){ 
    	return $this->subPageCss3(); 
    }elseif ($subPage_type == 4){ 
        return $this->subPageCss4(); 
    }elseif ($subPage_type == 5){ 
        return $this->subPageCss5(); 
    }elseif ($subPage_type == 6){ 
        return $this->subPageCss6();
    }elseif ($subPage_type == 7){ 
        return $this->subPageCss7();
    }elseif ($subPage_type == 8){ 
        return $this->subPageCss8();
    }
   } 
     
     
  /*
    用来给建立分页的数组初始化的函数。
   */ 
  function initArray(){ 
    for($i=0;$i<$this->sub_pages;$i++){ 
    $this->page_array[$i]=$i; 
    } 
    return $this->page_array; 
   } 
     
     
  /*
    construct_num_Page该函数使用来构造显示的条目
    即使：[1][2][3][4][5][6][7][8][9][10]
   */ 
  function construct_num_Page(){ 
    if($this->pageNums < $this->sub_pages){ 
    $current_array=array(); 
     for($i=0;$i<$this->pageNums;$i++){  
     $current_array[$i]=$i+1; 
     } 
    }else{ 
    $current_array=$this->initArray(); 
     if($this->current_page <= 3){ 
      for($i=0;$i<count($current_array);$i++){ 
      $current_array[$i]=$i+1; 
      } 
     }elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 ){ 
      for($i=0;$i<count($current_array);$i++){ 
      $current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i; 
      } 
     }else{ 
      for($i=0;$i<count($current_array);$i++){ 
      $current_array[$i]=$this->current_page-2+$i; 
      } 
     } 
    } 
      
    return $current_array; 
   } 
     
  /*
   构造普通模式的分页
   共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
   */ 
  function subPageCss1(){ 
   $subPageCss1Str=""; 
   $subPageCss1Str.="共".$this->nums."条记录，"; 
   $subPageCss1Str.="每页显示".$this->each_disNums."条，"; 
   $subPageCss1Str.="当前第".$this->current_page."/".$this->pageNums."页 "; 
    if($this->current_page > 1){ 
    $firstPageUrl=$this->subPage_link."1"; 
    $prewPageUrl=$this->subPage_link.($this->current_page-1); 
    $subPageCss1Str.="[<a href='$firstPageUrl'>首页</a>] "; 
    $subPageCss1Str.="[<a href='$prewPageUrl'>上一页</a>] "; 
    }else { 
    $subPageCss1Str.="[首页] "; 
    $subPageCss1Str.="[上一页] "; 
    } 
      
    if($this->current_page < $this->pageNums){ 
    $lastPageUrl=$this->subPage_link.$this->pageNums; 
    $nextPageUrl=$this->subPage_link.($this->current_page+1); 
    $subPageCss1Str.=" [<a href='$nextPageUrl'>下一页</a>] "; 
    $subPageCss1Str.="[<a href='$lastPageUrl'>尾页</a>] "; 
    }else { 
    $subPageCss1Str.="[下一页] "; 
    $subPageCss1Str.="[尾页] "; 
    } 
      
    return $subPageCss1Str; 
      
   } 
     
     
  /*
   构造经典模式的分页
   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
   */ 
  function subPageCss2(){ 
   $subPageCss2Str=""; 
   $subPageCss2Str.="共<font color='#ff0000'>".$this->nums."</font>条 当前第".$this->current_page."/".$this->pageNums."页 "; 
      
      
    if($this->current_page > 1){ 
    $firstPageUrl=$this->subPage_link."1"; 
    $prewPageUrl=$this->subPage_link.($this->current_page-1); 
    $subPageCss2Str.="[<a href='$firstPageUrl'>首页</a>] "; 
    $subPageCss2Str.="[<a href='$prewPageUrl'>上一页</a>] "; 
    }else { 
    $subPageCss2Str.="[首页] "; 
    $subPageCss2Str.="[上一页] "; 
    } 
      
   $a=$this->construct_num_Page(); 
    for($i=0;$i<count($a);$i++){ 
    $s=$a[$i]; 
     if($s == $this->current_page ){ 
     $subPageCss2Str.="<a class='number current' href='javascript:void(0)'>".$s."</a>"; 
     }else{ 
     $url=$this->subPage_link.$s; 
     $subPageCss2Str.="<a class='number' href='$url'>".$s."</a>"; 
     } 
    } 
      
    if($this->current_page < $this->pageNums){ 
    $lastPageUrl=$this->subPage_link.$this->pageNums; 
    $nextPageUrl=$this->subPage_link.($this->current_page+1); 
    $subPageCss2Str.=" [<a href='$nextPageUrl'>下一页</a>] "; 
    $subPageCss2Str.="[<a href='$lastPageUrl'>尾页</a>] "; 
    }else { 
    $subPageCss2Str.="[下一页] "; 
    $subPageCss2Str.="[尾页] "; 
    } 
    return $subPageCss2Str; 
   }
   
   /*
    个性分页效果，当前总效果第三种
   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
   */
   function subPageCss3(){
   	$subPageCss3Str="<div class=\"pagination\"><ul>";
   	$subPageCss3Str.="<li class=\"disabled\"><a href=\"javascript:;\">共".$this->pageNums."页</a></li>";
   
   	if($this->current_page > 1){
   		$firstPageUrl=$this->subPage_link."1";
   		$prewPageUrl=$this->subPage_link.($this->current_page-1);
   		$subPageCss3Str.="<li><a href='$firstPageUrl'>首页</a></li>";
   		$subPageCss3Str.="<li><a href='$prewPageUrl'>上一页</a></li>";
   	}else {
	   	$subPageCss3Str.="<li class=\"disabled\"><a href=\"javascript:;\">首页</a></li>";
	    $subPageCss3Str.="<li class=\"disabled\"><a href=\"javascript:;\">上一页</a></li>";
    }
   
       $a=$this->construct_num_Page();
       for($i=0;$i<count($a);$i++){
	       $s=$a[$i];
	       if($s == $this->current_page ){
				$subPageCss3Str.="<li class=\"active\"><a href=\"javascript:;\">".$s."</a></li>";
	       }else{
		       $url=$this->subPage_link.$s;
		       $subPageCss3Str.="<li><a href='$url'>".$s."</a></li>";
	       }
       }
   
       if($this->current_page < $this->pageNums){
	       $lastPageUrl=$this->subPage_link.$this->pageNums;
	       $nextPageUrl=$this->subPage_link.($this->current_page+1);
	       $subPageCss3Str.="<li><a href='$nextPageUrl'>下一页</a></li> ";
	       $subPageCss3Str.="<li><a href='$lastPageUrl'>尾页</a></li>";
       }else {
	       $subPageCss3Str.="<li class=\"disabled\"><a href=\"javascript:;\">下一页</a></li>";
	       $subPageCss3Str.="<li class=\"disabled\"><a href=\"javascript:;\">尾页</a></li>";
       }
       		return $subPageCss3Str;
       }
     /*
    个性分页效果，当前总效果第4种
    首页 上页 1 2 3 4 5 6 7 8 9 10 下页 尾页
   */      
 function subPageCss4(){ 
   $subPageCss2Str="";      
    if($this->current_page > 1){ 
    $firstPageUrl=$this->subPage_link."1"; 
    $prewPageUrl=$this->subPage_link.($this->current_page-1);     
    $subPageCss2Str.="共" . $this->nums . "记录"; 
    $subPageCss2Str.="<a tabindex='0' class='next fg-button ui-button ui-state-default' id='DataTables_Table_0_first' href='$firstPageUrl'>首页</a>"; 
    $subPageCss2Str.="<a tabindex='0' class='next fg-button ui-button ui-state-default' id='DataTables_Table_0_previous' href='$prewPageUrl'>上一页</a>"; 
    }else { 
    $subPageCss2Str.="共" . $this->nums . "记录"; 
    $subPageCss2Str.="<a tabindex='0' class='first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled' id='DataTables_Table_0_first' >首页</a>"; 
    $subPageCss2Str.="<a tabindex='0' class='first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled' id='DataTables_Table_0_previous'>上一页</a>"; 
    } 
    $subPageCss2Str.="<span>";  
   $a=$this->construct_num_Page(); 
    for($i=0;$i<count($a);$i++){ 
    $s=$a[$i]; 
     if($s == $this->current_page ){ 
     $subPageCss2Str.="<a tabindex='0' class='fg-button ui-button ui-state-default ui-state-disabled'>".$s."</a>"; 
     }else{ 
     $url=$this->subPage_link.$s; 
     $subPageCss2Str.="<a tabindex='0' class='fg-button ui-button ui-state-default' href='$url'>".$s."</a>"; 
     } 
    } 
    $subPageCss2Str.="</span>";   
    if($this->current_page < $this->pageNums){ 
    $lastPageUrl=$this->subPage_link.$this->pageNums; 
    $nextPageUrl=$this->subPage_link.($this->current_page+1); 
    $subPageCss2Str.="<a tabindex='0' class='next fg-button ui-button ui-state-default' id='DataTables_Table_0_next' href='$nextPageUrl'>下一页</a>"; 
    $subPageCss2Str.="<a tabindex='0' class='next fg-button ui-button ui-state-default' id='DataTables_Table_0_last' href='$lastPageUrl'>尾页</a>"; 
    }else { 
    $subPageCss2Str.="<a tabindex='0'  class='first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled' id='DataTables_Table_0_next'>下一页</a>"; 
    $subPageCss2Str.="<a tabindex='0' class='first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled' id='DataTables_Table_0_last'>尾页</a>"; 
    }  
    return $subPageCss2Str; 
   }  
 function subPageCss5(){ 
   $subPageCss2Str=""; 
   $subPageCss2Str.="<span><em class='fenya_em'><i>共<strong>".$this->nums."</strong>条,".$this->current_page."/".$this->pageNums."页</i>"; 
   $a=$this->construct_num_Page(); 
    for($i=0;$i<count($a);$i++){ 
        $s=$a[$i]; 
        if($s == $this->current_page ){ 
        $subPageCss2Str.="<a href='javascript:void(0)' class='this'>".$s."</a>"; 
        }else{ 
        $url=$this->subPage_link.$s; 
        $subPageCss2Str.="<a href='$url'>".$s."</a>"; 
        } 
    }   
    $subPageCss2Str.="</em></span>"; 
    return $subPageCss2Str; 
   }
  function subPageCss6(){ 
    $subPageCss2Str="";      
    if($this->current_page > 1){ 
      $firstPageUrl=$this->subPage_link."1"; 
      $prewPageUrl=$this->subPage_link.($this->current_page-1);     
      // $subPageCss2Str.="共" . $this->nums . "记录"; 
      $subPageCss2Str.="<ul class='pagination pagination-sm no-margin pull-right'><li><a href='$firstPageUrl'> |<< </a></li>"; 
      $subPageCss2Str.="<li><a href='$prewPageUrl'>«</a></li>"; 
    }else { 
      // $subPageCss2Str.="共" . $this->nums . "记录"; 
      $subPageCss2Str.="<ul class='pagination pagination-sm no-margin pull-right'><li><a href='$firstPageUrl'> |<< </a></li>"; 
      $subPageCss2Str.="<li><a href='$prewPageUrl'>«</a></li>"; 
    } 
    $subPageCss2Str.="<li>";  
    $a=$this->construct_num_Page(); 
    for($i=0;$i<count($a);$i++){ 
      $s=$a[$i]; 
      if($s == $this->current_page ){ 
        $subPageCss2Str.="<a class = 'bg-aqua'>".$s."</a>"; 
      }else{ 
        $url=$this->subPage_link.$s; 
        $subPageCss2Str.="<a href='$url'>".$s."</a>"; 
      } 
    } 
    $subPageCss2Str.="</li>";   
    if($this->current_page < $this->pageNums){ 
      $lastPageUrl=$this->subPage_link.$this->pageNums; 
      $nextPageUrl=$this->subPage_link.($this->current_page+1); 
      $subPageCss2Str.="<li><a href='$nextPageUrl'>»</a></li>"; 
      $subPageCss2Str.="<li><a href='$lastPageUrl'> >>| </a></li></ul>"; 
    }else { 
      $subPageCss2Str.="<li><a>»</a>"; 
      $subPageCss2Str.="<li><a> >>| </a></ul>"; 
    }  
    return $subPageCss2Str; 
  }
  /*
   构造普通模式的分页
   [首页] [上页] [下页] [尾页]
   */ 
  function subPageCss7(){ 
    $subPageCss1Str=""; 
    if($this->current_page > 1){ 
    $firstPageUrl=$this->subPage_link."1"; 
    $prewPageUrl=$this->subPage_link.($this->current_page-1); 
    // $subPageCss1Str.="[<a href='$firstPageUrl'>首页</a>] "; 
    $subPageCss1Str.="<a href='$prewPageUrl' class='btn02'>上一页</a> "; 
    }else { 
    // $subPageCss1Str.="[首页] "; 
    $subPageCss1Str.="<button class='btn02'>上一页</button> "; 
    } 
      
    if($this->current_page < $this->pageNums){ 
    $lastPageUrl=$this->subPage_link.$this->pageNums; 
    $nextPageUrl=$this->subPage_link.($this->current_page+1); 
    $subPageCss1Str.=" <a href='$nextPageUrl' class='btn02'>下一页</a> "; 
    // $subPageCss1Str.="[<a href='$lastPageUrl'>尾页</a>] "; 
    }else { 
    $subPageCss1Str.="<button class='btn02'>下一页</button> "; 
    // $subPageCss1Str.="[尾页] "; 
    } 
      
    return $subPageCss1Str; 
      
   }
/*
   构造经典模式的分页
   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
   <div class="list-view-page">
            <div class="wrapper">
                <div id="Pagination" class="pagination fl font18"><a href="#" class="prev">上一页</a><a href="#">1</a><span class="current">2</span><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#" class="next">下一页</a></div>          
            </div>
             <!--右侧总页数信息--自己修改-->
             <div class="page-total-info fr font18 color999">
                	<p>共<span id="total_page">45</span>条  &nbsp;&nbsp;当前第<span id="currntpage">1/5</span>页</p>
             </div>
        </div>
   */ 
  function subPageCss8(){ 
   $subPageCss2Str=""; 
   //$subPageCss2Str.="共<font color='#ff0000'>".$this->nums."</font>条 当前第".$this->current_page."/".$this->pageNums."页 "; 
    $subPageCss2Str.='<div class="list-view-page"><div class="wrapper">';   
      
    if($this->current_page > 1){ 
    $firstPageUrl=$this->subPage_link."1"; 
    $prewPageUrl=$this->subPage_link.($this->current_page-1); 
    $subPageCss2Str.='<div id="Pagination" class="pagination fl font14"><a href="'.$firstPageUrl.'">首页</a><a href="'.$prewPageUrl.'">上一页</a>'; 
    }else {  
    $subPageCss2Str.='<div id="Pagination" class="pagination fl font14"><a href="javascript:void(0)">首页</a><a href="javascript:void(0)">上一页</a>'; 
    } 
      
   $a=$this->construct_num_Page(); 
    for($i=0;$i<count($a);$i++){ 
    $s=$a[$i]; 
     if($s == $this->current_page ){ 
     $subPageCss2Str.='<span class="current">'.$s.'</span>'; 
     }else{ 
     $url=$this->subPage_link.$s; 
     $subPageCss2Str.='<a href="'.$url.'">'.$s.'</a>'; 
     } 
    } 
      
    if($this->current_page < $this->pageNums){ 
    $lastPageUrl=$this->subPage_link.$this->pageNums; 
    $nextPageUrl=$this->subPage_link.($this->current_page+1); 
    
    $subPageCss2Str.='<a href="'.$nextPageUrl.'" class="next">下一页</a>'; 
    $subPageCss2Str.='<a href="'.$lastPageUrl.'" class="next">尾页</a>'; 
    }else { 
    $subPageCss2Str.='<a href="javascript:void(0)" class="next">下一页</a>'; 
    $subPageCss2Str.='<a href="javascript:void(0)" class="next">尾页</a>'; 
    } 
    $subPageCss2Str.='</div></div>';
    $subPageCss2Str.='<div class="page-total-info fr font14 color999">';
    $subPageCss2Str.='<p>共<span id="total_page">'.$this->nums.'</span>条  &nbsp;&nbsp;当前第<span id="currntpage">'.$this->current_page."/".$this->pageNums.'</span>页</p>';
    $subPageCss2Str.='</div></div>';
    return $subPageCss2Str; 
   }            
} 
?>