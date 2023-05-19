<?php

namespace Controller;

//include "../Helpers/DBConnection.php";
include __DIR__."/../Helpers/DBConnection.php";

use DBConnection;
use PDO;
use PDOException;

class CRUDController {
    private $conn;

    public function __construct()
    {
        $conn = new DBConnection();
        $this->conn = $conn->connect();
    }

    /**
     * @param $query
     * @return array|string
     */
    public function index ($query)
    {
        try{
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            return $statement->fetchAll();
        }catch (PDOException $e){
            return "Data not found".$e->getMessage();
        }
    }
    /**
     * @param $query
     * @return string
     */
    public function store($query)
    {
        try {
            $this->conn->query($query);
            return true;
        }catch (PDOException $e){
            return "Data not inserted".$e->getMessage();
        }
    }

    /**
     * @param $query
     * @return string
     */
    public function update($query)
    {
        try {
            $this->conn->query($query);
            return true;
        }catch (PDOException $e){
            return "Data not inserted".$e->getMessage();
        }
    }

    /**
     * @param $query
     * @return mixed|string
     */
    public function show ($query)
    {
        try {
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            return $statement->fetch();
        }catch (PDOException $e){
            return "Data not inserted".$e->getMessage();
        }
    }

    /**
     * @param $query
     * @return string
     */
    public function destroy($query)
    {
        try {
            $this->conn->query($query);
            return true;
        }catch (PDOException $e){
            return "Data not inserted".$e->getMessage();
        }
    }
}
