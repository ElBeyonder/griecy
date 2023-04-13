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
    $ruc_numero = escape_post_value($conn,'ruc');
    $correo = escape_post_value($conn,'correo');
    $password_correo = escape_post_value($conn,'correo_password');
    $direccion_fisica = escape_post_value($conn,'direccion_fisica');
    $vereda = escape_post_value($conn,'vereda', 1);
    $logo = get_name_imagen($_FILES['logo'], $ruta_carpeta);
    $ruc_doc = get_name_imagen($_FILES['ruc_documento'], $ruta_carpeta);


    switch ($opcion){
        case 1:
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
            $sql = "UPDATE ".$tabla."
                    SET `nombre_completo`='".$nombre_completo."',`tipo`='".$tipo."',`num_documento_identidad`='".$num_documento_identidad."',`celular`='".$celular."',
                    `correo`='".$correo."',`direccion_fisica`='".$direccion_fisica."'
                    WHERE id='".$id."' ";
            if ($conn->query($sql) === TRUE) {
                $output='';
            } else {
                $output='e';
            }
            echo json_encode($output);
            break; /* ACTUALIZAR ITEM */
        case 6:
            echo tabla_jac($conn);
            break;
    }

