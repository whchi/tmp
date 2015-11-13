<?php
############################
#目的: 取得文章清單
#範例:{
#		"TOKEN":"LIST", //需要另外有一組class處理token驗證，這裡只是象徵性的觀念
#		"ORDER_BY":"C", //C=>created_at, P=>published_at, U=>updated_at
#		"SORT":"DESC" //ASC, DESC
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A03.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new ListArticles;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
