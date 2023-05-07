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
</head>
<body>

<div class="container-fluid mt-5">
    <!-- Content here -->
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-9">
                    <?php require "table.php"; ?>
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
<script src="js/sweetalert-app.js"></script>
<script src="js/app.js"></script>
</body>
</html>