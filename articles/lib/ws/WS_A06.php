<?php
include_once ROOT_PATH . 'articles/lib/article_lib.php';
class UpdateAnArticle
{
    private $obj;
    private $title, $body, $jsondata, $token, $articleid;
    private $result;
    public function __construct()
    {
        $this->obj = new ArticleLib;
    }
    public function setParam($rawdata)
    {
        $json = json_decode($rawdata, true);
        $this->articleid = $json['ARTICLE_ID'];
        $this->title = $json['TITLE'];
        $this->body = $json['BODY'];
        $this->jsondata = $rawdata;
    }
    public function set()
    {
        if (is_null($this->articleid)) {
            $this->result = array('ERROR_CODE' => '10', 'ERROR_MESSAGE' => 'NO article id');
            return json_encode($this->result);
        }
        if (is_null($this->title)) {
            $this->result = array('ERROR_CODE' => '40', 'ERROR_MESSAGE' => 'NO title');
            return json_encode($this->result);
        }
        if (is_null($this->body)) {
            $this->result = array('ERROR_CODE' => '50', 'ERROR_MESSAGE' => 'NO body');
            return json_encode($this->result);
        }

        $this->result = $this->obj->updateAnArticle($this->jsondata);
        return json_encode($this->result);
    }
}
