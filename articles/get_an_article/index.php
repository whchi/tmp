<?php
############################
#目的: 取得單一文章紀錄
#範例:{
#		"ARTICLE_ID":"1"
#	  }
#
#@author : whchi
#@date   : 20151102
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A01.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents("php://input");
}

$obj = new GetAnArticle;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
