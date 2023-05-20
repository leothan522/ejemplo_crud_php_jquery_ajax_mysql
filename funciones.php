<?php
session_start();
require "database/Query.php";
require "model/Persona.php";

$persona = new Persona();
$listarPersonas = $persona->getAll();
$i = 0;
$listarMunicipios = [
    1 => 'Juan German Roscio',
    2 => 'Ortiz'
];
$listarParroquias = [
    ['id' => 1,'nombre' => 'San Juan de los Morros', 'municipio' => 1],
    ['id' => 2,'nombre' => 'Parapara', 'municipio' => 1],
    ['id' => 3,'nombre' => 'Cantagallo', 'municipio' => 1],
    ['id' => 4,'nombre' => 'Ortiz', 'municipio' => 2],
    ['id' => 5,'nombre' => 'San Jose de Tiznados', 'municipio' => 2],
];
