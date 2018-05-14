<?php

namespace classes;

use interfaces\ComponentInterface;

/**
 * Class Db
 *
 * @package classes
 */
class Db implements ComponentInterface
{

    protected $host;
    protected $dbname;
    protected $user;
    protected $pass;
    protected $character;
    /** @var string */
    protected static $configFile = 'config.php';
    /** @var  \PDO */
    private $pdo;

    /**
     * Db constructor.
     *
     * @param array $config
     */
    final public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }

        $pdo = new \PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
            $this->user,
            $this->pass
        );
        if (isset($config['character'])) {
            $query = $pdo->prepare("SET NAMES '" . $this->character . "'");
            $query->execute();
            $query = $pdo->prepare("SET CHARACTER SET " . $this->character);
            $query->execute();
        }

        $this->pdo = $pdo;
    }

    /**
     * @param string $table
     * @param array $attributes
     *
     * @return string
     * @throws \PDOException
     */
    public function insert($table, $attributes)
    {
        $param = [];
        unset($attributes['id']);
        foreach ($attributes as $field => $value) {
            $param[':' . $field] = $value;
        }

        $fields = implode(', ', array_keys($attributes));
        $sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . implode(', ', array_keys($param)) . ')';
        if ($this->execute($sql, $param)) {
            return $this->pdo->lastInsertId();
        }

        $err = $this->pdo->errorInfo();

        return false;
    }

    /**
     * @param string $sql
     * @param array $param
     *
     * @return bool
     * @throws \Exception
     */
    public function execute($sql, $param = [])
    {
        return $this->pdo->prepare($sql)->execute($param);
    }

    /**
     * @param $table
     * @param $attributes
     * @param $filter_params
     *
     * @return bool
     */
    public function update($table, $attributes, $filter_params)
    {
        $set = [];
        $param = [];
        $where = [];
        foreach ($attributes as $field => $value) {
            if ($field == 'id') {
                continue;
            }

            $set[] = '`' . $field . '` = :' . $field;
            $param[':' . $field] = $value;
        }

        foreach ($filter_params as $field => $value) {
            $where[] = '`' . $field . '` = :w_' . $field;
            $param[':w_' . $field] = $value;
        }

        if (!empty($set)) {
            $set = implode(', ', $set);
            $where = implode(' and ', $where);
            $sql = 'update ' . $table . ' set ' . $set . ' where ' . $where;

            return $this->execute($sql, $param);
        }

        return true;
    }

    /**
     * @param string $table
     * @param array $attributes
     * @param string $select
     * @param string $order
     * @param string $limit
     *
     * @return \PDOStatement
     */
    public function select($table, $attributes = [], $select = '*', $order = '', $limit = '')
    {
        $query = "select $select from $table ";
        $param = [];
        if (!empty($attributes)) {
            $query .= 'where ';
            $where = [];
            foreach ($attributes as $filed => $val) {
                if (is_array($val)) {
                    $where[] = '`' . $filed . '` in (' . implode(',', $val) . ')';
                } else {
                    $param[':' . $filed] = $val;
                    $where[] = '`' . $filed . '` = :' . $filed;
                }
            }

            $query .= implode(' and ', $where);
        }

        $query .= !empty($order) ? ' order by ' . $order : '';
        $query .= !empty($limit) ? ' limit ' . $limit : '';

        return $this->getResult($query, $param);
    }

    /**
     * @param       $query
     * @param array $param
     *
     * @return \PDOStatement
     */
    public function getResult($query, $param = [])
    {
        $res = $this->pdo->prepare($query);
        $res->execute($param);

        return $res;
    }
}
