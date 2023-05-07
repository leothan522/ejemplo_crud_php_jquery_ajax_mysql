<?php
require "Conexion.php";

class Query{


    public function getFirst($sql)
    {
        $conexion = new Conexion();
        $statement = $conexion->CONEXION->prepare($sql);
        $statement->execute();
        $row = $statement->fetch();
        return $row;

    }

    public function getAll($sql)
    {
        $conexion = new Conexion();
        $statement = $conexion->CONEXION->prepare($sql);
        $statement->execute();
        $rows = array();
        while($result = $statement->fetch()){
            array_push($rows, $result);
        }
        return $rows;
    }

    public function save($sql)
    {
       $conexion = new Conexion();
       $statement = $conexion->CONEXION->prepare($sql);
       $statement->execute();
       return $statement;
    }

    public function count($sql)
    {
       $conexion = new Conexion();
       $statement = $conexion->CONEXION->prepare($sql);
       $statement->execute();
       $count = $statement->fetchColumn();
       return $count;
    }


}