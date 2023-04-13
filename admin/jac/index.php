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

    <title>JAC | <?php echo $titulo; ?></title>

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
                                <div class="col">
                                    <h3 class="page-title">Juntas de accion comunal</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                        <li class="breadcrumb-item active">JAC</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block bg-white mt-3 p-3 shadow">
                                        <div class="row p-3">
                                            <div class="col-sm-12" id="#content_result_items"><?php echo tabla_jac($conn); ?></div>
                                        </div>
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
    <script src="apli/jac.js"></script>
</body>
</html>




