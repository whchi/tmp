<?php
############################
#目的: 刪除單一文章
#範例:{
#		"ARTICLE_ID":"",
#	  }
#
#@author : whchi
#@date   : 20151113
############################
include_once '../config/config.php';
include_once ROOT_PATH . 'articles/lib/ws/WS_A05.php';
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$obj = new DeleteAnArticle;
$obj->setParam($HTTP_RAW_POST_DATA);
echo $obj->set();
