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

//Procesamos el Formulario
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
                    if (data.item){
                        $('#' + data.item).html(data.tr);
                    }else {
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

// EDITAR
function editPersona(id, item) {
    Cargando.fire();
    $.ajax({
        type: 'POST',
        url: 'procesar.php',
        data: {
            id: id,
            opcion: "show"
        },
        success: function (response) {
            let data = JSON.parse(response);
            if (data.result){
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
function deletePersona(id){
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

$(".delete-persona").click(function(e){
    e.preventDefault();
    //obtenemos los datos
    let id = this.dataset.id;
    deletePersona(id);
});

$('#btn_reset').click(function (env) {
    $('#parroquia').val('');
    $('#parroquia').trigger('change');
    $('#municipio').val('');
    $('#municipio').trigger('change');
    $('#form_opcion').val('guardar');
    $('#form_id').val('');
    $('#form_item').val('');
    $('#form_title').html('Nueva Persona');
});