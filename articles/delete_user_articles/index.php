<?php
############################
#目的: 刪除指定使用者文章列表
#範例:{
#		"USER_ID":"",
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A07.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new DeleteUserArticles;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
