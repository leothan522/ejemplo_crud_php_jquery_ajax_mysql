<?php
// start a session
session_start();
require "mysql/Query.php";
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

$data = array();

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

            $existe = $persona->existe($cedula, $id);

            if ($existe){

                $data['result'] = false;
                $data['icon'] = "warning";
                $data['existe'] = true;
                $data['message'] = "Cedula ya registrada.";

            }else{

                if ($opcion == "guardar"){
                    $guardar = $persona->save($cedula, $nombre, $telefono, $municipio, $parroquia);
                    if ($guardar){
                        $getPersona = $persona->first('cedula', '=', $cedula);
                        $count = $persona->count();
                        $data['result'] = true;
                        $data['icon'] = "success";
                        $data['message'] = "Persona Guardada correctamente.";
                        $data['item'] = false;
                        $data['tr'] = crearTdTable($count, $cedula, $nombre, $telefono, $municipio, $parroquia, $getPersona['id']);
                    }else{
                        $data['result'] = false;
                        $data['icon'] = "error";
                        $data['message'] = 'Error en el Model Mysql.';
                    }
                }

                if ($opcion == "editar"){
                    $editar = $persona->save($cedula, $nombre, $telefono, $municipio, $parroquia, $id);
                    if ($editar){
                        $data['result'] = true;
                        $data['icon'] = "success";
                        $data['message'] = "Datos Actualizados.";
                        $data['item'] = "tr_item_".$id;
                        $data['tr'] = crearTdTable($item, $cedula, $nombre, $telefono, $municipio, $parroquia, $id, true);
                    }else{
                        $data['result'] = false;
                        $data['icon'] = "error";
                        $data['message'] = 'Error en el Model Mysql.';
                    }
                }

            }


        } else {
            $data['result'] = false;
            $data['icon'] = "error";
            $data['message'] = 'Todos los campos son requeridos.';
        }

    }

    if ($opcion == "eliminar"){

        if (!empty($_POST['id'])){
            $id = $_POST['id'];
            $eliminar = $persona->delete($id);
            if ($eliminar){
                $data['result'] = true;
                $data['icon'] = "success";
                $data['message'] = "Persona Eliminada.";
            }else{
                $data['result'] = false;
                $data['icon'] = "error";
                $data['message'] = 'Error en el Model Mysql.';
            }
        }else{
            $data['result'] = false;
            $data['icon'] = "error";
            $data['message'] = 'Todos los campos son requeridos.';
        }
    }

    if ($opcion == "show"){
        if (!empty($_POST['id'])){
            $id = $_POST['id'];
            $getPersona = $persona->first('id', '=', $id);
            if ($getPersona){
                $data['result'] = true;
                $data['id'] = $getPersona['id'];
                $data['cedula'] = $getPersona['cedula'];
                $data['nombre'] = $getPersona['nombre'];
                $data['telefono'] = $getPersona['telefono'];
                $data['municipio'] = $getPersona['municipio'];
                $data['parroquia'] = $getPersona['parroquia'];
            }else{
                $data['result'] = false;
                $data['icon'] = "error";
                $data['message'] = 'Error en el Model Mysql.';
            }
        }else{
            $data['result'] = false;
            $data['icon'] = "error";
            $data['message'] = 'Todos los campos son requeridos.';
        }
    }


    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
