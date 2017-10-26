<?php

/**
 * Zend_Page
 * 翻页类整合
 * @param number $page_size 每页显示数量
 * @param number $num 总数量
 */
function pageAssignAction($page_size = 20, $num = 0, $condition = ''){
    //翻页
    //每页显示的条数
    $pageCurrent=$_REQUEST['p'];
    $pageCurrent = intval($pageCurrent);
    //每次显示的页数
    $sub_pages=5;
    //最大页数
    $max = ceil($num/$page_size);
    if ($pageCurrent > $max){
        $pageCurrent = $max;
    }

    //当前页码
    if ($pageCurrent <= 0) {
        $pageCurrent = 1;
    }
    $subPages=new \U0mo5\Tools\Templetes\Zend_Page($page_size,$num,$pageCurrent,$sub_pages,"?".($condition==''?'':$condition.'&')."p=",8);
    if ($num > $page_size){
        $this->assign('page',$subPages->pageShow());    //todo   页面引擎
    }
    $this->assign('p',$pageCurrent);
    return $pageCurrent;
}


