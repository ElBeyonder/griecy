<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $tabla = 'grupo_directivo';
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);
    $nombre = escape_post_value($conn,'nombre');

    switch ($opcion){
        case 1:
            $columnas = array('`nombre`');
            $valores = array($nombre);
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
            tabla_grupo_directivo($conn);
            break; /* LISTA ITEMS */
        case 5:
            $sql = "UPDATE ".$tabla."
                    SET `nombre`='".$nombre."'
                    WHERE id='".$id."' ";
            if ($conn->query($sql) === TRUE) {
                $output='';
            } else {
                $output='e';
            }
            echo json_encode($output);
            break; /* ACTUALIZAR ITEM */
    }

