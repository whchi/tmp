<?php
include_once ROOT_PATH . 'articles/lib/article_lib.php';
class DeleteUserArticles
{
    private $obj;
    private $userid;
    private $result;
    public function __construct()
    {
        $this->obj = new ArticleLib;
    }
    public function setParam($rawdata)
    {
        $json = json_decode($rawdata, true);
        $this->userid = $json['USER_ID'];
    }
    public function set()
    {
        if (is_null($this->userid)) {
            $this->result = array('ERROR_CODE' => '20', 'ERROR_MESSAGE' => 'NO user id');
            return json_encode($this->result);
        }
        $this->result = $this->obj->deleteUserArticles((int) $this->userid);
        return json_encode($this->result);
    }
}
