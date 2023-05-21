//Inicializamos Select2
$(".js-select2").select2({
    language: "es"
});

//Inicializamos InputMask
/*
Ejemplos
$('selector').inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
$(selector).inputmask("99-9999999");  //static mask
$(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options
*/

$('#cedula').inputmask("9{1,8}");
$('#telefono').inputmask({"mask": "(9999) 999-99.99",});

//Inicializamos la Funcion creada para Datatable pasando el ID de la tabla
datatable('table_personas');

$('.card-img-overlay').hide();
// Show loading overlay when ajax request starts
$( document ).ajaxStart(function() {
    $('.card-img-overlay').show();
});

// Hide loading overlay when ajax request completes
$( document ).ajaxStop(function() {
    $('.card-img-overlay').hide();
});

//Procesamos el Formulario
$('#form_persona_procesar2').submit(function (e) {
    e.preventDefault();
    let telefono = $('#telefono').inputmask("isComplete");
    let cedula = $('#cedula').inputmask("isComplete");

    if (telefono && cedula) {
        //do something
        Cargando.fire();
        //let key = this.dataset.key;

        $.ajax({
            type: 'POST',
            url: 'procesar2.php',
            data: $(this).serialize(),
            /*data: {
                key: key
            },*/
            success: function (response) {
                let data = JSON.parse(response);

                if (data.result) {

                    let table = $('#table_personas').DataTable();
                    let buttons = '<div class="btn-group btn-group-sm col-12 text-center" role="group" aria-label="Basic example">\n' +
                        '<button type="button" class="btn btn-primary edit-persona"\n' +
                        'onclick="editPersona(' + data.id + ', ' + data.item + ')">\n' +
                        '<i class="fa-solid fa-user-pen"></i>\n' +
                        '</button>\n' +
                        '<button type="button" class="btn btn-danger"\n' +
                        'onclick="deletePersona2(' + data.id + ')"\n' +
                        'id="btn_eliminar_' + data.id + '">\n' +
                        '<i class="fa-solid fa-trash-can"></i>\n' +
                        '</button>\n' +
                        '</div>';

                    if (data.add) {

                        table.row.add([
                            '<strong class="col-12 text-cente">'+ data.item+ '</strong>',
                            data.cedula,
                            data.nombre,
                            data.telefono,
                            data.municipio,
                            data.parroquia,
                            buttons
                        ]).draw();

                    } else {

                        let tr = $('#tr_item_' + data.id);
                        table
                            .cell(tr.find('.cedula')).data(data.cedula)
                            .cell(tr.find('.nombre')).data(data.nombre)
                            .cell(tr.find('.telefono')).data(data.telefono)
                            .cell(tr.find('.municipio')).data(data.municipio)
                            .cell(tr.find('.parroquia')).data(data.parroquia)
                            .draw();

                    }

                    Toast.fire({
                        icon: data.icon,
                        title: data.message
                    });

                } else {

                    if (data.error === "error_model") {
                        Alerta.fire({
                            icon: data.icon,
                            title: "Error en el MODEL",
                            text: data.message
                        });
                    }

                    if (data.error === "faltan_campos") {
                        Alerta.fire({
                            icon: data.icon,
                            title: 'Faltan datos.',
                            text: data.message
                        });
                    }

                }


            }
        });


    } else {
        if (!telefono) {
            $('#telefono_help').removeClass('d-none');
        }
        if (!cedula) {
            $('#cedula_help').removeClass('d-none');
        }
    }

});


// EDITAR
function editPersona(id, item) {
    Cargando.fire();
    $.ajax({
        type: 'POST',
        url: 'procesar2.php',
        data: {
            id: id,
            opcion: "show"
        },
        success: function (response) {
            let data = JSON.parse(response);
            if (data.result) {
                $('#form_title').html('Editar Persona');
                $('#cedula').val(data.cedula);
                $('#nombre').val(data.nombre);
                $('#telefono').val(data.telefono);
                $('#municipio').val(data.municipio);
                $('#municipio').trigger('change');
                $('#parroquia').val(data.parroquia);
                $('#parroquia').trigger('change');
                $('#form_opcion').val('editar');
                $('#form_id').val(data.id);
                $('#form_item').val(item);
                Toast.fire({
                    icon: "info",
                    title: "Editar Persona.",
                });
            }
        }
    });
}

//ELIMINAR
function deletePersona2(id) {
    //motramos la advertencia

    MessageDelete.fire().then((result) => {
        //Cargando.fire();
        //validamos que la respues sea si
        if (result.isConfirmed) {

            //Enviamos los datos
            $.ajax({
                type: 'POST',
                url: 'procesar2.php',
                data: {
                    id: id,
                    opcion: "eliminar"
                },
                success: function (response) {

                    let data = JSON.parse(response);

                    if (data.result) {

                        let table = $('#table_personas').DataTable();
                        let item = $('#btn_eliminar_' + id).closest('tr');
                        table
                            .row(item)
                            .remove()
                            .draw();
                        Toast.fire({
                            icon: data.icon,
                            title: data.message
                        });

                    } else {

                        Alerta.fire({
                            icon: data.icon,
                            title: 'Faltan datos.',
                            text: data.message
                        });

                    }

                }
            });

        }
    });
}

$('#btn_reset').click(function () {
    $('#parroquia').val('');
    $('#parroquia').trigger('change');
    $('#municipio').val('');
    $('#municipio').trigger('change');
    $('#form_opcion').val('guardar');
    $('#form_id').val('');
    $('#form_item').val('');
    $('#form_title').html('Nueva Persona');
});

//version anterior ****************************************************************************
//Procesar Formulario
$('#form_persona').submit(function (e) {
    e.preventDefault();
    let telefono = $('#telefono').inputmask("isComplete");
    let cedula = $('#cedula').inputmask("isComplete");

    if (telefono && cedula) {
        //do something
        Cargando.fire();
        //let key = this.dataset.key;

        $.ajax({
            type: 'POST',
            url: 'procesar.php',
            data: $(this).serialize(),
            /*data: {
                key: key
            },*/
            success: function (response) {
                let data = JSON.parse(response);

                if (data.icon === "error") {
                    Alerta.fire({
                        icon: data.icon,
                        title: 'Faltan datos.',
                        text: data.message
                    });
                }

                if (data.icon === "warning") {
                    let cedula_help = $('#cedula_help');
                    cedula_help.text(data.message);
                    cedula_help.removeClass('d-none');
                    Toast.fire({
                        icon: data.icon,
                        title: data.message
                    });
                }

                if (data.result) {
                    if (data.item) {
                        $('#' + data.item).html(data.tr);
                    } else {
                        $('#table_body').append(data.tr);
                    }
                    $('#telefono_help').addClass('d-none');
                    $('#cedula_help').addClass('d-none');
                    $('#btn_reset').trigger('click');
                    Toast.fire({
                        icon: data.icon,
                        title: data.message
                    });
                }

            }
        });


    } else {
        if (!telefono) {
            $('#telefono_help').removeClass('d-none');
        }
        if (!cedula) {
            $('#cedula_help').removeClass('d-none');
        }
    }

});

//ELIMINAR
function deletePersona(id) {
    //motramos la advertencia
    MessageDelete.fire().then((result) => {
        //validamos que la respues sea si
        if (result.isConfirmed) {

            //Enviamos los datos
            $.ajax({
                type: 'POST',
                url: 'procesar.php',
                data: {
                    id: id,
                    opcion: "eliminar"
                },
                success: function (response) {

                    let data = JSON.parse(response);

                    if (data.icon === "error") {
                        Alerta.fire({
                            icon: data.icon,
                            title: 'Faltan datos.',
                            text: data.message
                        });
                    }

                    if (data.result) {
                        Toast.fire({
                            icon: data.icon,
                            title: data.message
                        });
                        $('#tr_item_' + id).remove();
                    }

                }
            });

        }
    });
}

$(".delete-persona").click(function (e) {
    e.preventDefault();
    //obtenemos los datos
    let id = this.dataset.id;
    deletePersona(id);
});