<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Caracas');

class Conexion
{

    public $CONEXION;

    public function __construct()
    {

        $db_conexion = "mysql";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        $db_database = "curso";
        $db_username = "root";
        $db_password = "";
        $this->CONEXION = new PDO("$db_conexion:host=$db_host;dbname=$db_database", $db_username, $db_password);

    }


}

