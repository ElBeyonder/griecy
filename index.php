<?php
    require_once 'admin/config/config.php';
    validar_session_no_activa($link_admin);
?>
<!doctype html>
<html lang="es" class="js">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?php echo $logo_only; ?>">

    <title>Login | <?php echo $titulo; ?></title>

    <link rel="stylesheet" href="<?php echo $link_framework; ?>assets/css/dashlite.css?ver=3.1.2">
    <link id="skin-default" rel="stylesheet" href="<?php echo $link_framework; ?>assets/css/theme.css?ver=3.1.2">
    <link id="skin-default" rel="stylesheet" href="<?php echo $link_general; ?>node_modules/toastr/build/toastr.min.css">

    <!-- matter-css -->
    <link href="https://res.cloudinary.com/finnhvman/raw/upload/matter/matter-0.2.2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="login/dom/login.css">

</head>
<body class="nk-body bg-white npc-default pg-auth">
<input type="hidden" class="d-none" id="link_general" value="<?php echo $link_general; ?>">

    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="<?php echo $link_general; ?>" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo $logo_only; ?>" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo $logo_only; ?>" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content text-center">
                                        <h4 class="nk-block-title">Iniciar sesión</h4>
                                    </div>
                                </div>
                                <form onsubmit="event.preventDefault(event);" id="form_login" method="post">
                                    <div class="form-group">
                                        <label class="matter-textfield-outlined col-12">
                                            <input type="text" required id="usuario" name="usuario" placeholder=" "/>
                                            <span>Usuario o Correo <span class="text-danger">*</span></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="matter-textfield-outlined col-12">
                                            <input type="password" required id="password" name="password" placeholder=" "/>
                                            <span>Contraseña <span class="text-danger">*</span></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Iniciar sesión</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Cam - admin. All Rights Reserved (ONDERSOFT).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="<?php echo $link_framework; ?>assets/js/bundle.js?ver=3.1.2"></script>
    <script src="<?php echo $link_framework; ?>assets/js/scripts.js?ver=3.1.2"></script>
    <script src="<?php echo $link_general; ?>node_modules/toastr/build/toastr.min.js"></script>
    <script src="login/apli/login.js"></script>

</body>
</html>
