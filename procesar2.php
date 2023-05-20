<?php
// start a session
session_start();
require "database/Query.php";
require "model/Persona.php";

$response = array();

$listarMunicipios = [
    1 => 'Juan German Roscio',
    2 => 'Ortiz'
];

function getParroquia($parroquia)
{
    $listarParroquias = [
        ['id' => 1, 'nombre' => 'San Juan de los Morros', 'municipio' => 1],
        ['id' => 2, 'nombre' => 'Parapara', 'municipio' => 1],
        ['id' => 3, 'nombre' => 'Cantagallo', 'municipio' => 1],
        ['id' => 4, 'nombre' => 'Ortiz', 'municipio' => 2],
        ['id' => 5, 'nombre' => 'San Jose de Tiznados', 'municipio' => 2],
    ];
    $clave = null;
    foreach ($listarParroquias as $array) {
        if ($parroquia == $array['id']) {
            $clave = $array['nombre'];
        }
    }
    return $clave;
}

if ($_POST) {

    $persona = new Persona();
    $opcion = $_POST['opcion'];

    try {

        if ($opcion == "guardar" || $opcion == "editar") {

            if (
                !empty($_POST['cedula']) &&
                !empty($_POST['nombre']) &&
                !empty($_POST['telefono']) &&
                !empty($_POST['municipio']) &&
                !empty($_POST['parroquia']) &&
                isset($_POST['id'])
            ) {

                $cedula = $_POST['cedula'];
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                $municipio = $_POST['municipio'];
                $parroquia = $_POST['parroquia'];
                $id = $_POST['id'];
                $item = $_POST['item'];

                $data = [
                    $cedula,
                    $nombre,
                    $telefono,
                    $municipio,
                    $parroquia
                ];

                $existe = $persona->existe('cedula', '=', $cedula, $id);
                if ($existe) {

                    $response['result'] = false;
                    $response['error'] = 'existe_cedula';
                    $response['icon'] = "warning";
                    $response['message'] = "Cedula ya registrada.";

                } else {

                    if ($opcion == "guardar") {

                        $guardar = $persona->save($data);
                        $getPersona = $persona->first('cedula', '=', $cedula);
                        $count = $persona->count();
                        $add = true;
                        $message = "Persona Guardada correctamente.";
                    }

                    if ($opcion == "editar") {
                        $editar = $persona->update($id, 'cedula', $cedula);
                        $editar = $persona->update($id, 'nombre', $nombre);
                        $editar = $persona->update($id, 'telefono', $telefono);
                        $editar = $persona->update($id, 'municipio', $municipio);
                        $editar = $persona->update($id, 'parroquia', $parroquia);
                        $getPersona = $persona->find($id);
                        $count = $item;
                        $add = false;
                        $message = "Datos Actualizados";
                    }

                    $response['result'] = true;
                    $response['icon'] = "success";
                    $response['message'] = $message;
                    $response['add'] = $add;
                    $response['item'] = $count;
                    $response['id'] = $getPersona['id'];
                    $response['cedula'] = $getPersona['cedula'];
                    $response['nombre'] = $getPersona['nombre'];
                    $response['telefono'] = $getPersona['telefono'];
                    $response['municipio'] = $listarMunicipios[$getPersona['municipio']];
                    $response['parroquia'] = getParroquia($getPersona['parroquia']);

                }

            } else {
                $response['result'] = false;
                $response['error'] = 'faltan_campos';
                $response['icon'] = "info";
                $response['message'] = 'Todos los campos son requeridos.';
            }

        }

        if ($opcion == "eliminar") {

            if (!empty($_POST['id'])) {
                $id = $_POST['id'];
                $eliminar = $persona->delete($id);
                $response['result'] = true;
                $response['icon'] = "success";
                $response['message'] = "Persona Eliminada.";
            } else {
                $response['result'] = false;
                $response['icon'] = "info";
                $response['message'] = 'Todos los campos son requeridos.';
            }

        }

        if ($opcion == "show") {
            if (!empty($_POST['id'])) {
                $id = $_POST['id'];
                $getPersona = $persona->find($id);
                $response['result'] = true;
                $response['id'] = $getPersona['id'];
                $response['cedula'] = $getPersona['cedula'];
                $response['nombre'] = $getPersona['nombre'];
                $response['telefono'] = $getPersona['telefono'];
                $response['municipio'] = $getPersona['municipio'];
                $response['parroquia'] = $getPersona['parroquia'];
            } else {
                $response['result'] = false;
                $response['icon'] = "info";
                $response['message'] = 'Todos los campos son requeridos.';
            }
        }

    } catch (PDOException $e) {
        $response['result'] = false;
        $response['error'] = 'error_model';
        $response['icon'] = "error";
        $response['message'] = "PDOException {$e->getMessage()}";
    } catch (Exception $e) {
        $response['result'] = false;
        $response['error'] = 'error_model';
        $response['icon'] = "error";
        $response['message'] = "General Error: {$e->getMessage()}";
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

