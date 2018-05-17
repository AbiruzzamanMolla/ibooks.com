<?php

/**
 * Name: Database Class for pems
 * Author: Abiruzzaman Molla
 * Date: Apr 16,2018
 */

class Database
{
    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "root";
    private $dbname = "db_ibooks";
    private $pdo;

    public function __construct()
    {
        if (!isset($this->pdo)) {
            try {
                $link = new PDO("mysql:host=" . $this->hostdb . ";dbname=" . $this->dbname, $this->userdb, $this->passdb);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo = $link;
                
            } catch (PDOException $e) {
                die("Faild to Connect with Database" . $e->getMessage());
            }
        }
        
    }
    // Read Data
    // $sql = $this->pdo->prepare("SELECT * FROM tableName WHERE id=:id AND email=:email LIMIT 1");
    // $sql->bindValue(':id',$id);
    // $sql->bindValue(':email', $email);
    // $sql->excute();

    public function select($table, $data = array())
    {
        $sql = "SELECT ";
        $sql .= array_key_exists("select", $data) ? $data['select'] : '*';
        $sql .= ' FROM ' . $table;
        if (array_key_exists("where", $data)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($data['where'] as $key => $value) {
                $add = ($i > 0) ? ' AND ' : '';
                $sql .= "$add" . "$key=:$key";
                $i++;
            }
        }
        if (array_key_exists("order_by", $data)) {
            $sql .= ' ORDER BY ' . $data['order_by'];
        }
        if (array_key_exists("start", $data) && array_key_exists("limit", $data)) {
            $sql .= ' LIMIT ' . $data['start'] . ',' . $data['limit'];
        } elseif (!array_key_exists("start", $data) && array_key_exists("limit", $data)) {
            $sql .= ' LIMIT ' . $data['limit'];
        }

        $query = $this->pdo->prepare($sql);

        if (array_key_exists("where", $data)) {
            foreach ($data['where'] as $key => $value) {
                $query->bindValue(":$key", $value);
            }
        }
        $query->execute();
        if (array_key_exists("return_type", $data)) {
            switch ($data['return_type']) {
                case 'count':
                    $value = $query->rowCount();
                    break;

                case 'single':
                    $value = $query->fetch(PDO::FETCH_ASSOC);
                    break;

                default:
                    break;
            }

        } else {
            if ($query->rowCount() > 0) {
                $value = $query->fetchAll();
            }
        }
        return !empty($value) ? $value : false;

    }
    // insert data
    public function insert($table, $data)
    {
        if (!empty($data) && is_array($data)) {
            $keys = '';
            $values = '';
            $i = 0;
            $keys = implode(',', array_keys($data));
            $values = ":" . implode(', :', array_keys($data));
            $sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $values . ")";
            $query = $this->pdo->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(":$key", $val);
            }
            $insertData = $query->execute();
            if ($insertData) {
                $lastId = $this->pdo->lastInsertId();
                return $lastId;
            } else {
                return false;
            }
        }
    }
    // update data
    public function update($table, $data, $cond)
    {
        if (!empty($data) && is_array($data)) {
            $keyvalue = '';
            $wherecond = '';
            $i = 0;

            foreach ($data as $key => $val) {
                $add = ($i > 0) ? ' , ' : '';
                $keyvalue .= "$add" . "$key=:$key";
                $i++;
            }
            if (!empty($cond) && is_array($cond)) {
                $wherecond .= " WHERE ";
                $i = 0;
                foreach ($cond as $key => $val) {
                    $add = ($i > 0) ? ' AND ' : '';
                    $wherecond .= "$add" . "$key=:$key";
                    $i++;
                }
            }
            $sql = "UPDATE " . $table . " SET " . $keyvalue . $wherecond;
            $query = $this->pdo->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(":$key", $val);
            }
            foreach ($cond as $key => $val) {
                $query->bindValue(":$key", $val);
            }
            $updateData = $query->execute();
            $query->bindValue(":$key ", $val);
            return $updateData ? $query->rowCount() : false;
        } else {
            return false;
        }
    }
    // delete data
    public function delete($table, $cond)
    {
        if (!empty($cond) && is_array($cond)) {
            $wherecond .= " WHERE ";
            $i = 0;
            foreach ($cond as $key => $val) {
                $add = ($i > 0) ? ' AND ' : '';
                $wherecond .= "$add" . "$key=:$key";
                $i++;
            }
        }
        $sql = "DELETE FROM " . $table . $wherecond;
        $query = $this->pdo->prepare($sql);
        foreach ($cond as $key => $val) {
            $query->bindValue(":$key", $val);
        }
        $delete = $query->execute();
        return $delete ? true : false;
    }
}
?>
