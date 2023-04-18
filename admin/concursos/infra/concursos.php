<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $tabla = 'concursos';
    $ruta_carpeta = '../dom/img/';
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);
    $nombre = escape_post_value($conn,'nombre');
    $codigo = escape_post_value($conn,'codigo');
    $version = escape_post_value($conn,'version');
    $fecha_inicio = escape_post_value($conn,'fecha_inicio');
    $fecha_fin = escape_post_value($conn,'fecha_fin');
    $estado = escape_post_value($conn,'estado');

    switch ($opcion){
        case 1:
            $doc_convocatoria = get_name_imagen($_FILES['doc_convocatoria'], $ruta_carpeta) ?? '';
            $columnas = array('`nombre`, `fecha_inicio`, `fecha_fin`, `codigo`, `version`, `doc_convocatoria`, `estado`');
            $valores = array($nombre, $fecha_inicio, $fecha_fin, $codigo, $version, $doc_convocatoria, $estado);
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
            tabla_concursos($conn);
            break; /* LISTA ITEMS */
        case 5:
            $sql = "UPDATE ".$tabla."
                    SET `nombre`='".$nombre."', `fecha_inicio`='".$fecha_inicio."', `fecha_fin`='".$fecha_fin."', `codigo`='".$codigo."', `version`='".$version."',
                     `doc_convocatoria`='".$doc_convocatoria."', `estado`='".$estado."'
                    WHERE id='".$id."' ";
            if ($conn->query($sql) === TRUE) {
                $output='';
            } else {
                $output='e';
            }
            echo json_encode($output);
            break; /* ACTUALIZAR ITEM */
    }

