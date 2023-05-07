<div class="card">
    <div class="card-header" id="form_title">
        Nueva Persona
    </div>
    <div class="card-body">
        <form id="form_persona">
            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="text" class="form-control" placeholder="Cedula" name="cedula" id="cedula">
                <small id="cedula_help" class="form-text text-danger d-none">
                    La campo cedula es obligatorio.
                </small>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre">
                <small id="nombre_help" class="form-text text-danger d-none">
                    El campo nombes es obligatorio.
                </small>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" placeholder="Telefono" name="telefono" id="telefono">
                <small id="telefono_help" class="form-text text-danger d-none">
                    El campo telefono esta incompleto.
                </small>
            </div>
            <div class="form-group">
                <label for="municipio">Municipio</label>
                <select class="form-control js-select2" name="municipio" id="municipio">
                    <option value="">Seleccione</option>
                    <?php foreach ($listarMunicipios as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
                <small id="municipio_help" class="form-text text-danger d-none">
                    We'll never share your email with
                </small>
            </div>
            <div class="form-group">
                <label for="parroquia">Parroquia</label>
                <select class="form-control js-select2" name="parroquia" id="parroquia">
                    <option value="">Seleccione</option>
                    <?php foreach ($listarParroquias as $parroquia) { ?>
                        <option value="<?php echo $parroquia['id']; ?>"><?php echo $parroquia['nombre']; ?></option>
                    <?php } ?>
                </select>
                <small id="parroquia_help" class="form-text text-danger d-none">
                    We'll never share your email with
                </small>
            </div>
            <div class="row ml-1 mr-1 justify-content-between">
                <input type="hidden" name="opcion" value="guardar" id="form_opcion">
                <input type="hidden" name="id" value="" id="form_id">
                <input type="hidden" name="item" value="" id="form_item">
                <button type="reset" class="btn btn-secondary" id="btn_reset">Cancelar</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>