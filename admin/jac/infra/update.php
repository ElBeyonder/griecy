<?php
    session_start();
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];
    $ruta_carpeta='../dom/img/';
    $tabla = 'terceros';
    $id_usuario = id_usuario($conn);
    $id = escape_post_value($conn,'id', NULL);


    switch ($opcion){
        case 1:

            $id_jac = escape_post_value($conn,'id_jac',1);
            $nombre_completo = escape_post_value($conn,'nombre_completo','Jhon Zaens');
            $num_doc_identidad = escape_post_value($conn,'num_doc_identidad', 11111111);
            $lugar_expedicion = escape_post_value($conn,'lugar_expedicion', 'Santander de Quilichao');
            $celular = escape_post_value($conn,'celular', 31125636365);
            $correo = escape_post_value($conn,'correo', '');
            $direccion_fisica = escape_post_value($conn,'direccion_fisica', 'CLL 1 # 45-62');
            $cargo = escape_post_value($conn,'cargo', 'voluntario');
            $imagen_doc_identidad = get_name_imagen($_FILES['imagen_cc'], $ruta_carpeta) ?? '';

            $columnas = array('`id_jac`, `nombre_completo`, `num_doc_identidad`, `lugar_expedicion`, `celular`, `correo`, `direccion_fisica`, `cargo`, `img_cc`, `id_usuario`');
            $valores = array($id_jac, $nombre_completo, $num_doc_identidad, $lugar_expedicion, $celular, $correo, $direccion_fisica, $cargo, $imagen_doc_identidad, $id_usuario);
            $crear_item = crear_item($conn, 'terceros', $columnas, $valores);
            echo json_encode($crear_item);
            break;
        case 2:
            $eliminar_item = eliminar_item($conn, $tabla, 'id', $id);
            echo json_encode($eliminar_item);
            break;
        case 3:
            $logo = get_name_imagen($_FILES['logo'], $ruta_carpeta) ?? '';
            $ruc_documento = get_name_imagen($_FILES['ruc_documento'], $ruta_carpeta) ?? '';
            $id = escape_post_value($conn,'id', NULL);
            $id_grupo_directivo = escape_post_value($conn,'id_grupo_directivo', 1);
            $nombre = escape_post_value($conn,'nombre', 'JAC-'.$id);
            $personeria_juridica = escape_post_value($conn,'personeria_juridica', '1996-03-17');
            $celular = escape_post_value($conn,'celular', 3502853627);
            $nit = escape_post_value($conn,'nit', 1062321358-5);
            $rut = escape_post_value($conn,'rut', 1002536245);
            $ruc_numero = escape_post_value($conn,'ruc_numero', 15002525);
            $email = escape_post_value($conn,'email', 'ceo@');
            $email_password = escape_post_value($conn,'email_password', '');
            $direccion_fisica = escape_post_value($conn,'direccion_fisica', '');

            $sql = "UPDATE junta_accion_comunal 
                    SET `id_grupo_directivo`='".$id_grupo_directivo."', `logo`=".($logo ? "'".$logo."'" : "logo").",`nombre`='".$nombre."',`personeria_juridica`='".$personeria_juridica."',
                        `celular`='".$celular."', `nit`='".$celular."',`rut`='".$rut."',`ruc_numero`='".$ruc_numero."',`ruc_documento`=".($ruc_documento ? "'".$ruc_documento."'" : "ruc_documento").",`email`='".$email."',
                        `email_password`='".$email_password."',`direccion_fisica`='".$direccion_fisica."' 
                    WHERE id=".$id." ";
            if ($conn->query($sql) === TRUE) {
                $output='r';
            } else {
                $output="Error updating record: " . $conn->error;
            }
            $conn->close();
            echo json_encode($output);
            break;
        case 4:



            break;
        case 5:
            $id_jac = escape_post_value($conn,'id_jac');
            tabla_tercero_jac($conn, $id_jac);
            break;
    }







