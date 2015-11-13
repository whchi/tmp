<?php
include_once ROOT_PATH . 'articles/lib/article_lib.php';
class GetAnArticle
{
    private $obj;
    private $articleid;
    private $result;
    public function __construct()
    {
        $this->obj = new ArticleLib;
    }
    public function setParam($rawdata)
    {
        $json = json_decode($rawdata, true);
        $this->articleid = $json['ARTICLE_ID'];
    }
    public function set()
    {
        if (is_null($this->articleid)) {
            $this->result = array('ERROR_CODE' => '10', 'ERROR_MESSAGE' => 'NO article id');
            return json_encode($this->result);
        }
        $this->result = $this->obj->getAnArticle((int) $this->articleid);
        return json_encode($this->result);
    }
}
