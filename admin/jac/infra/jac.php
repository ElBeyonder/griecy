<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $tabla = 'junta_accion_comunal';
    $ruta_carpeta='../dom/img/';
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);

    $nombre = escape_post_value($conn,'nombre');
    $personeria_juridica = escape_post_value($conn,'personeria_juridica');
    $celular = escape_post_value($conn,'celular');
    $nit = escape_post_value($conn,'nit');
    $rut = escape_post_value($conn,'rut');
    $ruc_numero = escape_post_value($conn,'ruc_numero');
    $correo = escape_post_value($conn,'correo');
    $password_correo = escape_post_value($conn,'correo_password');
    $direccion_fisica = escape_post_value($conn,'direccion_fisica');
    $vereda = escape_post_value($conn,'vereda', 1);


    switch ($opcion){
        case 1:
            $logo = get_name_imagen($_FILES['logo'], $ruta_carpeta) ?? '';
            $ruc_doc = get_name_imagen($_FILES['ruc_documento'], $ruta_carpeta) ?? '';
            $columnas = array('`logo`, `nombre`, `personeria_juridica`, `celular`, `nit`, `rut`, `ruc_numero`, `ruc_documento`, `id_vereda`, `email`, `email_password`, `direccion_fisica`, `id_usuario`');
            $valores = array($logo, $nombre, $personeria_juridica, $celular, $nit, $rut, $ruc_numero, $ruc_doc, $vereda, $correo, $password_correo, $direccion_fisica, $id_usuario);
            $crear_item = crear_item($conn, $tabla, $columnas, $valores);
            echo json_encode($crear_item);
            break; /* CREAR ITEM */
        case 2:
            $eliminar_item = eliminar_item($conn, $tabla, 'id', $id);
            echo json_encode($eliminar_item);
            break; /* ELIMINAR ITEM */
        case 3:
            $columnas=array('*');
            $leer_item = leer_item($conn, $columnas, $tabla, 'id', $id);
            echo json_encode($leer_item);
            break; /* LEER ITEM */
        case 4:
            tabla_terceros($conn);
            break; /* LISTA ITEMS */
        case 5:
            $id_jac = escape_post_value($conn,'id_jac',1);
            $nombre_completo = escape_post_value($conn,'nombre_completo','Jhon Zaens');
            $num_doc_identidad = escape_post_value($conn,'num_doc_identidad', 11111111);
            $lugar_expedicion = escape_post_value($conn,'lugar_expedicion', 'Santander de Quilichao');
            $celular = escape_post_value($conn,'celular', 31125636365);
            $direccion_fisica = escape_post_value($conn,'direccion_fisica', 'CLL 1 # 45-62');
            $cargo = escape_post_value($conn,'cargo', 'voluntario');
            $imagen_doc_identidad = get_name_imagen($_FILES['imagen_cc'], $ruta_carpeta) ?? '';

            $columnas = array('`id_jac`, `nombre_completo`, `num_doc_identidad`, `lugar_expedicion`, `celular`, `correo`, `direccion_fisica`, `cargo`, `img_cc`, `id_usuario`');
            $valores = array($id_jac, $nombre_completo, $num_doc_identidad, $lugar_expedicion, $celular, $correo, $direccion_fisica, $cargo, $imagen_doc_identidad, $id_usuario);
            $crear_item = crear_item($conn, 'terceros', $columnas, $valores);
            echo json_encode($crear_item);
            break; /* Crear tercero */
        case 6:
            tabla_jac($conn, $link_general);
            break;
    }

