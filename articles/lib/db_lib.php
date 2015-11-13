<?php
include_once ROOT_PATH . 'articles/config/db_config.php';
// include_once ROOT_PATH . 'articles/lib/debug_lib.php';
/**
 * access to database
 */
class DBAccess
{
    /**
     * @var mixed
     */
    private $host, $user, $passwd, $dblink, $dbname, $dsn, $db_tblcharset;
    /**
     * @var mixed
     */
    private $stmt;
    /**
     * @param $dbname
     */
    public function __construct($dbname)
    {
        $this->getDbConnect($dbname);
    }
    // public function __destruct()
    // {
    //     $this->DBLINK = null;
    // }
    /**
     * @param $dbname
     */
    public function getDbConnect($dbname)
    {
        $this->dbname = $dbname;
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->passwd = DB_PASS;
        $this->db_ltype = DB_LTYPE;
        $this->db_tblcharset = DB_TBLCHARSET;
        $this->dsn = "{$this->db_ltype}:host={$this->host};dbname={$this->dbname};charset={$this->db_tblcharset}";
        try {
            $this->DBLINK = new PDO($this->dsn, $this->user, $this->passwd);
            $this->DBLINK->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connetcion failed: ' . $e->getMessage();
        }
    }
    /**
     * 複寫PDO::prepare，讓外部可以調用
     * @param  SQL-statement $query
     */
    public function prepareQuery($query)
    {
        $this->stmt = $this->DBLINK->prepare($query);
    }
    /**
     * 綁定單一變數,避免SQL injection
     * 如要綁定多變數需要啟動prepare的emulation mode,但對prepare的效能有很大影響
     * @param mixed $param 傳入變數名稱
     * @param mixed $value 傳入參數值
     */
    public function bindSingleParam($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindParam($param, $value, $type);
    }
    /**
     * @return int
     */
    public function getAffetedRows()
    {
        return $this->stmt->rowCount();
    }
    /**
     * @param int $type 0->column name=>value;1=>num=>value
     * @return mixed
     */
    public function getQuery($type = 0)
    {
        if ($type === 0) {
            $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        }
        if ($type === 1) {
            $this->stmt->setFetchMode(PDO::FETCH_NUM);
        }
        $this->stmt->execute();
        while ($row = $this->stmt->fetch()) {
            $rst[] = $row;
        }
        if (isset($rst) && !is_null($rst)) {
            return array('ERROR_CODE' => '0', 'DATA' => $rst);
        } else {
            return array('ERROR_CODE' => '99', 'ERROR_MESSAGE' => 'DB ERROR, check debuglog');
            // debug prefix: "An error occured while connect to db, more informations:"
            // $debuglog->appendDebug(json_encode($this->stmt->errorInfo()));
        }
    }
    public function doQuery()
    {
        $this->stmt->execute();
        if ($this->getAffetedRows() !== 0) {
            return array('ERROR_CODE' => '0');
        } else {
            return array('ERROR_CODE' => '99', 'ERROR_MESSAGE' => 'DB ERROR, check debuglog');
            // debug prefix: "An error occured while connect to db, more informations:"
            // $debuglog->appendDebug(json_encode($this->stmt->errorInfo()));
        }
    }
    /**
     * 執行須回傳的多條件sql statement
     * @param  array $whereAry 條件參數
     * @return mixed
     */
    public function getQueryWithMultiWhere($whereAry, $type = 0)
    {
        if ($type === 0) {
            $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        }
        if ($type === 1) {
            $this->stmt->setFetchMode(PDO::FETCH_NUM);
        }
        $this->stmt->execute($whereAry);
        while ($row = $this->stmt->fetch()) {
            $rst[] = $row;
        }
        if (isset($rst) && !is_null($rst)) {
            return array('ERROR_CODE' => '0', 'DATA' => $rst);
        } else {
            return array('ERROR_CODE' => '99', 'ERROR_MESSAGE' => 'DB ERROR, check debuglog');
            // debug prefix: "An error occured while connect to db, more informations:"
            // $debuglog->appendDebug(json_encode($this->stmt->errorInfo()));
        }
    }
    /**
     * 執行不須回傳的多條件sql statement
     * @param array $whereAry 條件參數
     * @return mixed
     */
    public function doQueryWithMultiWhere($whereAry)
    {
        $this->stmt->execute($whereAry);
        if ($this->getAffetedRows() !== 0) {
            return array('ERROR_CODE' => '0');
        } else {
            return array('ERROR_CODE' => '99', 'ERROR_MESSAGE' => 'DB ERROR, check debuglog');
            // debug prefix: "An error occured while connect to db, more informations:"
            // $debuglog->appendDebug(json_encode($this->stmt->errorInfo()));
        }
    }
    public function closeDbConn()
    {
        $this->DBLINK = null;
    }
}
