<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $tabla = 'terceros';
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);
    $nombre_completo = escape_post_value($conn,'nombre_completo');
    $num_documento_identidad = escape_post_value($conn,'num_documento_identidad');
    $celular = escape_post_value($conn,'celular', 000);
    $correo = escape_post_value($conn,'correo');
    $direccion_fisica = escape_post_value($conn,'direccion_fisica', '');

    switch ($opcion){
        case 1:
            $columnas = array('`id_usuario`, `nombre_completo`, `tipo`, `num_documento_identidad`, `celular`, `correo`, `direccion_fisica`');
            $valores = array($id_usuario, $nombre_completo, $tipo, $num_documento_identidad, $celular, $correo, $direccion_fisica);
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
    }

