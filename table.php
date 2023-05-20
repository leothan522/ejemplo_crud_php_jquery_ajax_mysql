<div class="card">
    <div class="card-header">
        Personas Registradas
        <div class="card-tools" id="card_tools">

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_personas" class="table table-hover table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center" style="width: 5%;">#</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Parroquia</th>
                    <th scope="col">&nbsp;</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                foreach ($listarPersonas as $persona) {
                    $i++;
                    $clave = null;
                    foreach ($listarParroquias as $parroquia) {
                        if ($persona['parroquia'] == $parroquia['id']) {
                            $clave = $parroquia['nombre'];
                        }
                    }
                    ?>
                    <tr id="tr_item_<?php echo $persona['id']; ?>">
                        <td class="text-center table_id"><strong><?php echo $i; ?></strong></td>
                        <td class="cedula"><?php echo $persona['cedula']; ?></td>
                        <td class="nombre"><?php echo $persona['nombre']; ?></td>
                        <td class="telefono"><?php echo $persona['telefono']; ?></td>
                        <td class="municipio"><?php echo $listarMunicipios[$persona['municipio']]; ?></td>
                        <td class="parroquia"><?php echo $clave; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary edit-persona"
                                        onclick="editPersona(<?php echo $persona['id']; ?>, <?php echo $i; ?>)">
                                    <i class="fa-solid fa-user-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger"
                                        onclick="deletePersona2(<?php echo $persona['id']; ?>)"
                                        id="btn_eliminar_<?php echo $persona['id']; ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>