<?php
############################
#目的: 取得文章清單
#範例:{
#		"ARTICLE_ID":"",
#		"TITLE":"",
#		"BODY":""
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A06.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new UpdateAnArticle;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
