<?php
// start a session
session_start();
require "database/Query.php";
require "model/Persona.php";

function crearTdTable($i, $cedula, $nombre, $telefono, $municipio, $parroquia, $id, $editar= false)
{
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

    $clave = null;
    foreach ($listarParroquias as $array) {
        if ($parroquia == $array['id']){
            $clave = $array['nombre'];
        }
    }

    if ($editar){
        $td = '
            <th scope="row" class="text-center">'.$i.'</th>
            <td>'.$cedula.'</td>
            <td>'.$nombre.'</td>
            <td>'.$telefono.'</td>
            <td>'.$listarMunicipios[$municipio].'</td>
            <td>'.$clave.'</td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" onclick="editPersona('.$id.', '.$i.')">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletePersona('.$id.')">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </td>
                        ';
    }else{
        $td = '
    <tr id="tr_item_'.$id.'">
            <th scope="row" class="text-center">'.$i.'</th>
            <td>'.$cedula.'</td>
            <td>'.$nombre.'</td>
            <td>'.$telefono.'</td>
            <td>'.$listarMunicipios[$municipio].'</td>
            <td>'.$clave.'</td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" onclick="editPersona('.$id.', '.$i.')">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletePersona('.$id.')">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </td>
        </tr>
                        ';
    }
    return preg_replace("/[\r\n|\n|\r]+/", " ", $td);;
}

$response = array();

if ($_POST){

    $opcion = $_POST['opcion'];
    $persona = new Persona();

    if ($opcion == "guardar" || $opcion == "editar") {

        if (!empty($_POST['cedula']) && !empty($_POST['nombre']) && !empty($_POST['telefono']) &&
            !empty($_POST['municipio']) && !empty($_POST['parroquia']) && isset($_POST['id'])) {

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

            if ($existe){

                $response['result'] = false;
                $response['icon'] = "warning";
                $response['existe'] = true;
                $response['message'] = "Cedula ya registrada.";

            }else{

                if ($opcion == "guardar"){
                    $guardar = $persona->save($data);
                    if ($guardar){
                        $getPersona = $persona->first('cedula', '=', $cedula);
                        $count = $persona->count();
                        $response['result'] = true;
                        $response['icon'] = "success";
                        $response['message'] = "Persona Guardada correctamente.";
                        $response['item'] = false;
                        $response['tr'] = crearTdTable($count, $cedula, $nombre, $telefono, $municipio, $parroquia, $getPersona['id']);
                    }else{
                        $response['result'] = false;
                        $response['icon'] = "error";
                        $response['message'] = 'Error en el Model Mysql.';
                    }
                }

                if ($opcion == "editar"){

                    $editar = $persona->update($id, 'cedula', $cedula);
                    $editar = $persona->update($id, 'nombre', $nombre);
                    $editar = $persona->update($id, 'telefono', $telefono);
                    $editar = $persona->update($id, 'municipio', $municipio);
                    $editar = $persona->update($id, 'parroquia', $parroquia);

                    if ($editar){
                        $response['result'] = true;
                        $response['icon'] = "success";
                        $response['message'] = "Datos Actualizados.";
                        $response['item'] = "tr_item_".$id;
                        $response['tr'] = crearTdTable($item, $cedula, $nombre, $telefono, $municipio, $parroquia, $id, true);
                    }else{
                        $response['result'] = false;
                        $response['icon'] = "error";
                        $response['message'] = 'Error en el Model Mysql.';
                    }
                }

            }


        } else {
            $response['result'] = false;
            $response['icon'] = "error";
            $response['message'] = 'Todos los campos son requeridos.';
        }

    }

    if ($opcion == "eliminar"){

        if (!empty($_POST['id'])){
            $id = $_POST['id'];
            $eliminar = $persona->delete($id);
            if ($eliminar){
                $response['result'] = true;
                $response['icon'] = "success";
                $response['message'] = "Persona Eliminada.";
            }else{
                $response['result'] = false;
                $response['icon'] = "error";
                $response['message'] = 'Error en el Model Mysql.';
            }
        }else{
            $response['result'] = false;
            $response['icon'] = "error";
            $response['message'] = 'Todos los campos son requeridos.';
        }
    }

    if ($opcion == "show"){
        if (!empty($_POST['id'])){
            $id = $_POST['id'];
            $getPersona = $persona->find($id);
            if ($getPersona){
                $response['result'] = true;
                $response['id'] = $getPersona['id'];
                $response['cedula'] = $getPersona['cedula'];
                $response['nombre'] = $getPersona['nombre'];
                $response['telefono'] = $getPersona['telefono'];
                $response['municipio'] = $getPersona['municipio'];
                $response['parroquia'] = $getPersona['parroquia'];
            }else{
                $response['result'] = false;
                $response['icon'] = "error";
                $response['message'] = 'Error en el Model Mysql.';
            }
        }else{
            $response['result'] = false;
            $response['icon'] = "error";
            $response['message'] = 'Todos los campos son requeridos.';
        }
    }


    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
