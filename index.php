<?php require "funciones.php"; ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP | JQUERY | AJAX</title>
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/select2/css/select2.min.css">
    <!-- our project just needs Font Awesome Solid + Brands -->
    <link href="resources/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="resources/fontawesome/css/brands.css" rel="stylesheet">
    <link href="resources/fontawesome/css/solid.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="resources/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="resources/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="resources/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>
<body>

<div class="container-fluid mt-5">
    <!-- Tabla Personas -->
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            Personas Registradas
                            <div class="card-tools" id="card_tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Loading overlay -->
                            <div class="card-img-overlay">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="dataContainer">
                                <!-- Tabla Personas -->
                                <?php require "table.php"; ?>
                                <!-- Display pagination links -->
                                <?php echo $pagination->createLinks(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <?php require "form.php"; ?>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="resources/jquery/jquery-3.6.4.min.js"></script>
<script src="resources/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="resources/sweetalert2/sweetalert2.all.min.js"></script>
<script src="resources/select2/js/select2.full.min.js"></script>
<script src="resources/select2/js/i18n/es.js"></script>
<script src="resources/inputmask/jquery.inputmask.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="resources/datatables/jquery.dataTables.min.js"></script>
<script src="resources/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="resources/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="resources/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="resources/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="resources/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="resources/jszip/jszip.min.js"></script>
<script src="resources/pdfmake/pdfmake.min.js"></script>
<script src="resources/pdfmake/vfs_fonts.js"></script>
<script src="resources/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="resources/datatables-buttons/js/buttons.print.min.js"></script>
<script src="resources/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="js/sweetalert-app.js"></script>
<script src="js/datatable-app.js"></script>
<script src="js/app.js"></script>
</body>
</html>