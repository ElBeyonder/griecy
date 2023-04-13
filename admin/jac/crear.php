<?php
    session_start();
    require_once '../config/config.php';
    validar_session_activa($link_general);
?>
<!doctype html>
<html lang="es" class="js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Crear JAC | <?php echo $titulo; ?></title>

    <?php require_once '../config/links.php'; ?>

    <!-- eventos -->
    <link rel="stylesheet" href="dom/jac.css">

</head>
<body class="nk-body bg-lighter npc-default has-sidebar">

    <div class="nk-app-root">
        <div class="nk-main ">
            <?php include '../nav/side-bar.php'; ?>
            <div class="nk-wrap">
                <?php include '../nav/navbar.php'; ?>
                <div class="nk-content">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col-s12">
                                <h3 class="page-title">Crear JAC</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active">Crear JAC</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block bg-white mt-3 p-3 shadow">
                                    <form id="form_crear_jac" method="post" onsubmit="event.preventDefault(event);">
                                        <div class="row p-3 ">
                                            <div class="mb-1 mt-1 col-sm-12 col-md-6 text-center">
                                                <label>Logo</label>
                                                <input data-allowed-file-extensions="jpg jpeg png gif bmp svg" type="hidden" id="logo" name="logo" class="dropify">
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-6 text-center">
                                                <label>Documento de Ruc <span class="text-danger">*</span></label>
                                                <input data-allowed-file-extensions="jpg jpeg png pdf" type="hidden" id="ruc" name="ruc_documento" class="dropify">
                                            </div>

                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="text" name="nombre" placeholder=" "/>
                                                        <span>Nombre<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="text" class="date-input" name="personeria_juridica" placeholder=" "/>
                                                        <span>Personeria Juridica<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="number" name="celular" placeholder=" "/>
                                                        <span>Celular<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="number" name="nit" placeholder=" "/>
                                                        <span>NIT<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="number" name="RUT" placeholder=" "/>
                                                        <span>RUT<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="number" name="RUT" placeholder=" "/>
                                                        <span>RUC #<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" data-ui="xl" data-placeholder="Elegir vereda...">
                                                            <?php echo lista_veredas_select($conn); ?>
                                                        </select>
                                                        <label class="form-label-outlined" for="outlined-select">Vereda</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input required type="email" name="correo" placeholder=" "/>
                                                        <span>Correo<span class="text-danger">*</span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-1 mt-1 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="matter-textfield-outlined col-12">
                                                        <input type="number" name="correo_password" placeholder=" "/>
                                                        <span>Contraseña de correo</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 text-center mb-1 mt-1">
                                                <button type="submit" class="btn btn-success">Crear <i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include '../nav/footer.php'; ?>
            </div>
        </div>
        <?php include_once 'modales.html'; ?>
    </div>
    <?php require_once '../config/scripts.php'; ?>
    <script src="apli/crear.js"></script>
</body>
</html>
