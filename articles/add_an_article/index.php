<?php
############################
#目的: 增加文章
#範例:{
#		"USER_ID":"",
#		"TITLE":"title you want",
#		"BODY":"content you want"
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A04.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new AddAnArticle;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
