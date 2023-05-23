<?php
require "Model.php";

class Persona extends Model
{
    public function __construct()
    {
        $this->TABLA = "personas";
        $this->DATA = [
            'cedula',
            'nombre',
            'telefono',
            'municipio',
            'parroquia'
        ];
    }
}