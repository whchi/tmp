<?php
include_once ROOT_PATH . 'articles/lib/article_lib.php';
class ListArticles
{
    private $obj;
    private $token, $sort, $orderby, $jsondata;
    private $result;
    public function __construct()
    {
        $this->obj = new ArticleLib;
    }
    public function setParam($rawdata)
    {
        $json = json_decode($rawdata, true);
        $this->token = $json['TOKEN'];
        // $this->orderby = $json['ORDER_BY'];
        // $this->sort = $json['SORT'];
        $this->jsondata = $rawdata;
    }
    public function set()
    {
        if (is_null($this->token) || $this->token !== 'LIST') {
            $this->result = array('ERROR_CODE' => '30', 'ERROR_MESSAGE' => 'invalid token');
            return json_encode($this->result);
        }
        $this->result = $this->obj->listArticles($this->jsondata);
        return json_encode($this->result);
    }
}
