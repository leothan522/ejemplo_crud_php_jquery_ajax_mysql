<?php

class Persona
{
    public function getAll()
    {
        $query = new Query();
        $sql = "SELECT * FROM `personas`;";
        $rows = $query->getAll($sql);
        return $rows;
    }

    public function count()
    {
        $query = new Query();
        $sql = "select count(*) from personas;";
        $count = $query->count($sql);
        return $count;
    }

    public function first($campo, $operador, $valor)
    {
        $query = new Query();
        $sql = "SELECT * FROM `personas` WHERE `$campo` $operador '$valor';";
        $row = $query->getFirst($sql);
        return $row;
    }

    public function existe($cedula, $id = null)
    {
        $query = new Query();
        if (!$id) {
            $sql = "select * from `personas` where `cedula` = '$cedula';";
        } else {
            $sql = "select * from `personas` where `cedula` = '$cedula' AND  `id` != '$id';";
        }
        $row = $query->getFirst($sql);
        return $row;
    }

    function save($cedula, $nombre, $telefono, $municipio, $parroquia, $id = null)
    {
        $query = new Query();
        if (!$id) {
            //nuevo
            $sql = "INSERT INTO `personas` (`cedula`, `nombre`, `telefono`, `municipio`, `parroquia`) 
                VALUES ('$cedula', '$nombre', '$telefono', '$municipio', '$parroquia');";
        } else {
            //editar
            $sql = "UPDATE `personas` SET 
                    `cedula` = '$cedula', 
                    `nombre` = '$nombre', 
                    `telefono` = '$telefono', 
                    `municipio` = '$municipio', 
                    `parroquia` = '$parroquia' 
                    WHERE `id` = '$id';";
        }
        $row = $query->save($sql);
        return $row;
    }

    public function delete($id)
    {
        $query = new Query();
        $sql = "DELETE FROM `personas` WHERE  `id` = '$id';";
        $rows = $query->save($sql);
        return $rows;
    }

}