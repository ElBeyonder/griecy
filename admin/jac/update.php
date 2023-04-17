<?php
    session_start();
    require_once '../config/config.php';
    validar_session_activa($link_general);
    if (isset($_GET['id'])){
        $id_jac = $conn->real_escape_string($_GET['id']);
        $nombre_jac = $conn->real_escape_string($_GET['jac']);
    }else{
        header('Location: '.$link_general.'admin/jac/');
    }
    function datos_jac ($conn, $id_jac){
        $sql = "SELECT * FROM junta_accion_comunal WHERE id = $id_jac ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return $row;
    }
    $jac = datos_jac($conn, $id_jac);

?>
<!doctype html>
<html lang="es" class="js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>JAC - <?php echo quitar_guiones($nombre_jac); ?> | <?php echo $titulo; ?></title>

    <?php require_once '../config/links.php'; ?>

    <!-- eventos -->
    <link rel="stylesheet" href="../dom/jac.css">
</head>
<body class="nk-body bg-lighter npc-default has-sidebar">
<input type="hidden" class="d-none" name="id_jac" id="id_jac" value="<?php echo $id_jac; ?>">

<div class="nk-app-root">
    <div class="nk-main ">
        <?php include '../nav/side-bar.php'; ?>
        <div class="nk-wrap">
            <?php include '../nav/navbar.php'; ?>
            <div class="nk-content">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo quitar_guiones($nombre_jac); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                <li class="breadcrumb-item active">JAC-<?php echo $id_jac; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block bg-white mt-3 p-3 shadow">
                                <form onsubmit="event.preventDefault();" id="form_actualizar_jac" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mt-3 mb-3">
                                            <label>Logo</label>
                                            <input type="file" name="logo" class="dropify" data-default-file="<?php echo $link_general; ?>admin/jac/dom/img/<?php echo $jac['logo']; ?>">
                                        </div>
                                        <div class="col-sm-12 col-md-6 mt-3 mb-3">
                                            <label>Ruc Documento</label>
                                            <input type="file" name="ruc_documento" class="dropify" data-default-file="<?php echo $link_general; ?>admin/jac/dom/img/<?php echo $jac['ruc_documento']; ?>">
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="text" name="nombre" value="<?php echo $jac['nombre']; ?>" placeholder=" "/>
                                                <span>Nombre<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required readonly class="date-input" type="text" name="personeria_juridica" value="<?php echo $jac['personeria_juridica']; ?>" placeholder=" "/>
                                                <span>Personeria juridica<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                         <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="number" name="celular" value="<?php echo $jac['celular']; ?>" placeholder=" "/>
                                                <span>Celular<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="number" name="nit" value="<?php echo $jac['nit']; ?>" placeholder=" "/>
                                                <span>Nit<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="number" name="rut" value="<?php echo $jac['rut']; ?>" placeholder=" "/>
                                                <span>Rut<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="number" name="ruc_numero" value="<?php echo $jac['ruc_numero']; ?>" placeholder=" "/>
                                                <span>Ruc #<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="email" name="email" value="<?php echo $jac['email']; ?>" placeholder=" "/>
                                                <span>Correo <span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mt-1 mb-1">
                                            <label class="matter-textfield-outlined col-12">
                                                <input required type="text" name="email_password" value="<?php echo $jac['email_password']; ?>" placeholder=" "/>
                                                <span>Correo contraseña<span class="text-danger">*</span></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-12 text-center mt-1 mb-1">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="nk-content-body">
                            <div class="nk-block bg-white mt-3 p-3 shadow">
                                <div class="row">
                                    <div class="col-sm-12 text-center mt-1 mb-2">
                                        <h5>Miembros</h5>
                                    </div>
                                    <div class="col-sm-12" id="content_tabla_terceros">
                                        <?php tabla_tercero_jac($conn, $id_jac); ?>
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
    <?php include_once 'modales.html'; ?>
</div>

<?php require_once '../config/scripts.php'; ?>
<script src="../apli/update.js"></script>
</body>
</html>




