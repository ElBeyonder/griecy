<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $tabla = 'usuarios';
    $id_usuario = id_usuario($conn);
    $salt = bin2hex(random_bytes(16));

    if (isset($_POST['id'])) {
        $id = $conn->real_escape_string($_POST['id']);
    } else {
        $id = null;
    }
    if (isset($_POST['usuario'])) {
            $usuario = $conn->real_escape_string($_POST['usuario']);
        } else {
            $usuario = 'example-365';
        }
    if (isset($_POST['nombre_completo'])) {
         $nombre_completo = $conn->real_escape_string($_POST['nombre_completo']);
     }else{
         $nombre_completo = 'Jhon Zaens';
    }
    if (isset($_POST['celular'])) {
        $celular = $conn->real_escape_string($_POST['celular']);
    } else {
        $celular = 3609991111;
    }
    if (isset($_POST['correo'])) {
        $correo = $conn->real_escape_string($_POST['correo']);
    } else {
        $correo = 'example@example.com';
    }
    if (isset($_POST['direccion_fisica'])) {
        $direccion_fisica = $conn->real_escape_string($_POST['direccion_fisica']);
    } else {
        $direccion_fisica = 'CRRA 15 SUR # 4S 11';
    }
    if (isset($_POST['password'])) {
        $password = $conn->real_escape_string($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $password_salt = $password . $salt;
    }
    if (isset($_POST['tipo_usuario'])) {
        $tipo_usuario = $conn->real_escape_string($_POST['tipo_usuario']);
    } else {
        $tipo_usuario = 'VENDEDOR';
    }


    switch ($opcion){
        case 1:
            $columnas = array('`usuario`, `nombre_completo`, `celular`, `correo`, `direccion_fisica`, `password`, `password_salt`, `tipo_usuario`');
            $valores = array($usuario, $nombre_completo, $celular, $correo, $direccion_fisica, $password, $password_salt, $tipo_usuario);
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
             tabla_usuarios($conn, $connect, $id_usuario);
            break; /* LISTA ITEMS */
        case 5:
            $sql = "UPDATE usuarios
                    SET `usuario`='".$usuario."',`nombre_completo`='".$nombre_completo."', `celular`='".$celular."',`correo`='".$correo."', `direccion_fisica`='".$direccion_fisica."', `tipo_usuario`='".$tipo_usuario."'
                    WHERE id='".$id."' ";
            if ($conn->query($sql) === TRUE) {
                $output='';
            } else {
                $output='e';
            }
            echo json_encode($output);
            break; /* ACUTALIZAR ITEM */
    }

