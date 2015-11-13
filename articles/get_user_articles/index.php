<?php
############################
#目的: 取得指定使用者文章清單
#範例:{
#		"USER_ID":"1"
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A02.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new GetUserArticles;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
