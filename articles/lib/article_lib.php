<?php
/**
 * article's CRUD controller
 */
include_once ROOT_PATH . 'articles/lib/db_lib.php';

class ArticleLib
{
    /**
     * @var mixed
     */
    private $db_obj;
    public function __construct()
    {
        $this->db_obj = new DBAccess(DB_NAME);
    }
    /**
     * 指定ID取得單一文章記錄
     * @param  [int] $id 文章ID
     */
    public function getAnArticle($id)
    {
        $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
        $this->db_obj->prepareQuery($sql);
        $this->db_obj->bindSingleParam(':id', $id);
        $rst = $this->db_obj->getQuery();
        return $rst;
    }
    /**
     * 取得指定使用者文章列表
     * @param  [int] $id 使用者ID
     */
    public function getArticlesByUserId($id)
    {
        $sql = 'SELECT * FROM `articles` WHERE `user_id` = :id';
        $this->db_obj->prepareQuery($sql);
        $this->db_obj->bindSingleParam(':id', $id);
        $rst = $this->db_obj->getQuery();
        return $rst;
    }
    /**
     * @param $json
     */
    public function listArticles($json)
    {
        $orderby = '';
        $sort = '';
        $json = json_decode($json, true);
        switch ($json['ORDER_BY']) {
            case 'P':
                $orderby = 'published_at';
                break;
            case 'U':
                $orderby = 'updated_at';
                break;
            default:
                $orderby = 'created_at';
                break;
        }
        if ($json['SORT'] !== 'ASC' || $json['SORT'] !== 'DESC') {
            $sort = 'ASC';
        }
        $sql = 'SELECT * FROM `articles` ORDER BY :orderby :sort';
        $this->db_obj->prepareQuery($sql);
        $rst = $this->db_obj->getQueryWithMultiWhere(array(
            ':orderby' => $orderby,
            ':sort' => $sort,
        ));
        return $rst;
    }
    /**
     * 新增單一文章記錄
     * @param string $json
     */
    public function addAnArticle($json)
    {
        $json = json_decode($json, true);
        $sql = 'INSERT INTO `articles`
    			(`user_id`, `title`, `body`, `created_at`, `updated_at`, `published_at`)
    			VALUES
    			(:userid, :title, :body, :c, :u, :p);';
        $this->db_obj->prepareQuery($sql);
        $rst = $this->db_obj->doQueryWithMultiWhere(array(
            ':userid' => $json['USER_ID'],
            ':title' => $json['TITLE'],
            ':body' => $json['BODY'],
            ':c' => date('Y-m-d h:i:s'),
            ':u' => date('Y-m-d h:i:s'),
            ':p' => date('Y-m-d h:i:s'),
        ));
        return $rst;
    }
    /**
     * 刪除單一文章
     * @param  int $id 文章ID
     */
    public function deleteAnArticle($id)
    {
        $sql = 'DELETE FROM `articles` WHERE `id` = :id';
        $this->db_obj->prepareQuery($sql);
        $this->db_obj->bindSingleParam(':id', $id);
        $rst = $this->db_obj->doQuery();
        return $rst;
    }
    /**
     * 更新單一文章標題與內容
     * @param  $json
     */
    public function updateAnArticle($json)
    {
        $json = json_decode($json, true);
        $sql = 'UPDATE `articles` SET
    			`title`=:title,`body`=:body,`updated_at`=:u
    			WHERE `id`=:id';
        $this->db_obj->prepareQuery($sql);
        $rst = $this->db_obj->doQueryWithMultiWhere(array(
            ':title' => $json['TITLE'],
            ':body' => $json['BODY'],
            ':u' => date('Y-m-d h:i:s'),
            ':id' => $json['ARTICLE_ID'],
        ));
        return $rst;
    }

    public function deleteUserArticles($id)
    {
    	$sql = 'DELETE FROM `articles` WHERE `user_id` = :uid';
    	$this->db_obj->prepareQuery($sql);
    	$this->db_obj->bindSingleParam(':uid', $id);
    	$rst = $this->db_obj->doQuery();
    	return $rst;
    }
}
