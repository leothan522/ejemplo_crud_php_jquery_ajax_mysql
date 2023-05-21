<?php
session_start();
require "funciones/paginate.php";
require "database/Query.php";
require "model/Persona.php";

$persona = new Persona();

$listarMunicipios = [
    1 => 'Juan German Roscio',
    2 => 'Ortiz'
];
$listarParroquias = [
    ['id' => 1, 'nombre' => 'San Juan de los Morros', 'municipio' => 1],
    ['id' => 2, 'nombre' => 'Parapara', 'municipio' => 1],
    ['id' => 3, 'nombre' => 'Cantagallo', 'municipio' => 1],
    ['id' => 4, 'nombre' => 'Ortiz', 'municipio' => 2],
    ['id' => 5, 'nombre' => 'San Jose de Tiznados', 'municipio' => 2],
];

$listarPersonas = $persona->paginate($limit, $offset);
$i = $offset;
require "table.php";
echo $pagination->createLinks();
?>
