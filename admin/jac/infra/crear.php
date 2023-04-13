<?php
    session_start();
    require_once '../../config/config.php';
    $tabla = 'terceros';
    $ruta_carpeta = "../dom/img/";

    $logo = get_name_imagen($_FILES["logo"], $ruta_carpeta);
    $ruc = get_name_imagen($_FILES["ruc"], $ruta_carpeta);
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);
    $nombre = escape_post_value($conn,'nombre');
    $personeria_juridica = escape_post_value($conn,'personeria_juridica');
    $celular = escape_post_value($conn,'celular');
    $nit = escape_post_value($conn,'nit');
    $rut = escape_post_value($conn,'rut');
    $ruc_numero = escape_post_value($conn,'ruc');
    $correo = escape_post_value($conn,'correo');
    $password_correo = escape_post_value($conn,'correo_password');
    $direccion_fisica = escape_post_value($conn,'direccion_fisica');









