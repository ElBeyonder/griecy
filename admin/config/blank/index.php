<?php
    session_start();
    require_once '../config/config.php';
?>
<!doctype html>
<html lang="es" class="js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Blank | <?php echo $titulo; ?></title>

    <?php require '../config/links.php'; ?>

</head>
<body class="nk-body bg-lighter npc-default has-sidebar">
    <div class="nk-app-root">
        <div class="nk-main ">
                <?php include '../nav/side-bar.php'; ?>
            <div class="nk-wrap">
                <?php include '../nav/navbar.php'; ?>
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm mb-3">
                                        <div class="navbar-tools d-flex bg-white col-sm-12 p-3">
                                            <div class="form-control-wrap ms-lg-3 ">
                                                <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div>
                                                <input type="text" class="form-control" id="search" placeholder="Buscar...">
                                            </div>
                                            <div class="content-button ms-lg-3">
                                                <button type="button" class="btn btn-success">Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block mt-3">
                                        <div class="row bg-white">
                                            <div class="col-sm-12" id="result_events">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php include '../nav/footer.php'; ?>
            </div>
        </div>
    </div>
    <?php require '../config/scripts.php'; ?>
</body>
</html>




