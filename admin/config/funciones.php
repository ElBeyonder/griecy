<?php

    /* scape variables */
    function escape_post_value($conn, $key, $default_value = '') {
        global $conn;
        $value = $default_value;
        if (isset($_POST[$key])) {
            $value = $conn->real_escape_string($_POST[$key]);
        }
        return $value;
    }
    function get_name_imagen($imagen, $ruta_carpeta) {
        if (!isset($imagen["name"]) || empty($imagen["name"])) {
            return '';
        }

        $extensiones_permitidas = array("jpg", "jpeg", "png", "gif"); // Extensiones permitidas
        $extension = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION)); // Obtener extensión del archivo

        // Verificar si la extensión es válida
        if (!in_array($extension, $extensiones_permitidas)) {
            return '';
        }

        // Verificar si la imagen es válida
        if (!getimagesize($imagen["tmp_name"])) {
            return '';
        }

        // Generar nombre de archivo único
        $nombre_archivo = "img-" . uniqid() . "." . $extension;

        // Verificar si la carpeta existe, de lo contrario crearla
        if (!is_dir($ruta_carpeta)) {
            mkdir($ruta_carpeta, 0777, true);
        }

        // Mover archivo a la carpeta
        $ruta_archivo = $ruta_carpeta . $nombre_archivo;
        if (!move_uploaded_file($imagen["tmp_name"], $ruta_archivo)) {
            return '';
        }

        // Retornar el nombre del archivo guardado
        return $nombre_archivo;
    }
    /* scape variables */

    /*  crud */
    function paginador($total_links, $page){
        $output='';
        $output.='<br><nav><ul class="pagination mt-2">';
        $previous_link = '';
        $next_link = '';
        $page_link = '';
        if ($total_links > 5) {
            if ($page < 5) {
                for ($count = 1; $count <= 5; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            } else {
                $end_limit = $total_links - 5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $end_limit; $count <= $total_links; $count++) {
                        $page_array[] = $count;
                    }
                } else {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $page - 1; $count <= $page + 1; $count++) {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }
        } else {
            for ($count = 1; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        }

        if (!empty($page_array)) {
            for ($count = 0, $countMax = count($page_array); $count < $countMax; $count++) {
                if ($page == $page_array[$count]) {

                    /* Pagina Activa */
                    $page_link.='<li class="page-item active" data-pagina="'.$page_array[$count].'"><a style="font-size: 20pt !important;" class="disabled page-link " data-page="'.$page_array[$count].'" href="#OnderSoft">'.$page_array[$count].'</a></li>';

                    $previous_id = $page_array[$count] - 1;
                    if ($previous_id > 0) {
                        $previous_link='<li  class="page-item mr-2 ml-2"><a  class="page-link page-pase mr-2 ml-2" href="javascript:void(0)" data-page="'.$previous_id.'"><i style="font-size: 18pt !important;" class="fad fa-chevron-left"></i></a></li>';
                    } else {
                        $previous_link='<li  class="page-item disabled mr-2 ml-2"><a style="font-size: 18pt !important;" class="page-link disabled mr-2 ml-2" href="#OnderSoft"><i class="fad fa-chevron-left"></i></a></li>';
                    }
                    $next_id = $page_array[$count] + 1;
                    if ($next_id > $total_links) {
                        $next_link = '<li  class="disabled page-item mr-2 ml-2"><a style="font-size: 18pt !important;" class="page-link disabled mr-2 ml-2" href="#OnderSoft"><i class="fad fa-chevron-right"></i></a></a></li>';
                    } else {

                        $next_link = '<li class="page-item mr-2 ml-2"><a style="font-size: 18pt !important;" class="page-link page-pase mr-2 ml-2" href="javascript:void(0)" data-page="'.$next_id.'"><i class="fad fa-chevron-right"></i></a></li>';
                    }
                } else {

                    if ($page_array[$count] === '...') {
                        $page_link.= '<li class="page-item disabled"><a style="font-size: 15pt !important;" class="page-link" href="#OnderSoft">...</a></li>';
                    } else {
                        $page_link.='<li class="page-item"><a style="font-size: 15pt !important;" class="page-link page-pase" href="javascript:void(0)" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
                    }
                }
            }
        }
        $output.=$previous_link.$page_link.$next_link;
        $output.='</ul>';
        return $output;
    }
    function leer_item($conexion, $array_columnas, $tabla, $id, $id_item){
        $columnas = implode(', ', $array_columnas);
        $sql=("SELECT ".$columnas." FROM ".$tabla." WHERE ".$id." = ".$id_item." ");
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $output[]=$row;
            }
        } else {
            $output='';
        }
        $conexion->close();
        return $output;
    }
    function eliminar_item($conexion,  $tabla, $id, $id_item){

        $sql=" DELETE FROM ".$tabla." WHERE ".$id."=".$id_item." ";
        if ($conexion->query($sql) === TRUE) {
            $output='r';
        } else {
            $output='e';
        }
        $conexion->close();
        echo $output;
    }
    function crear_item($conexion,  $tabla, $array_columnas, $array_datos_usuario){
        $columnas = implode(', ', $array_columnas);
        $datos_usuario = implode("','", $array_datos_usuario);
        $sql =("INSERT INTO ".$tabla." ($columnas)
            VALUES ('".$datos_usuario."')");
        if ($conexion->query($sql) === TRUE) {
            $output="r";
        } else {
            $output="e";
        }
        return $output;
    }
    function actualizar_item($conn, $tabla, $id, $columnas) {
        $columnas_actualizadas = array();
        foreach ($columnas as $columna => $valor) {
            $columnas_actualizadas[] = "$columna = '$valor'";
        }
        $columnas_actualizadas = implode(", ", $columnas_actualizadas);

        $sql = "UPDATE $tabla SET $columnas_actualizadas WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            $output='r';
        } else {
            $output='e';
        }
        return $output;
    }
    /*  crud (FIN) */

    /* alt */
    function obtenerPrimerasDosLetras($cadena) {
        return substr($cadena, 0, 2);
    }

    /* Numerico */
    function quitar_formato_moneda($valor){
        $valor=str_replace('.','', $valor);
        $valor=str_replace(',','.', $valor);
        return $valor;
    }
    function money_format_decimals($valor){
        return $money = number_format($valor, 2, ',','.');
    }
    /* Numerico (FIN) */

    /* modulo gastos */
    function lista_centro_costos_select($conn, $id_empresa){
        $output='';
        $sql = "SELECT * FROM centros_de_costos WHERE id_empresa=".$id_empresa." ;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $output.='<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
            }
        } else {
            $output.='<option value="" disabled>Sin resultados...</option>';
        }
        return $output;
    }
    function lista_veredas_select($conn){
        $output='';
        $sql = "SELECT * FROM vereda ORDER BY nombre ASC ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $output.='<option value="" selected disabled>Buscar...</option>';
            while($row = $result->fetch_assoc()) {
                $output.='<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
            }
        } else {
            $output.='<option value="" disabled>Sin resultados...</option>';
        }
        return $output;
    }
    /* modulo gastos (fin) */


    /* sessiones */
    function validar_session_activa($link_admin) {
        if (isset($_SESSION['login']) && $_SESSION['login'] === 'login') {

        }else{
            header('Location: '.$link_admin);
            exit();
        }
    }
    function validar_session_no_activa($link_admin) {
        session_start();
        if (isset($_SESSION['login']) && $_SESSION['login'] === 'login') {
            header('Location: '.$link_admin.'usuarios/');
            exit();
        }else{

        }
    }
    function eliminar_sesiones() {
            session_start();
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        return 'done';
    }
    function id_usuario($conn) {
        if (isset($_SESSION['u_id'])) {
            $u_id=$_SESSION['u_id'];
        } else {
            $u_id=null;
        }
        return $u_id = $conn->real_escape_string($u_id);
    }
    /* sessiones (FIN) */

    /* Tablas */
    function tabla_ventas($conn, $id_empresa){

        $tabla = "facturacion";
        $limit = $_POST['limit'] ?? 5;
        $order = $_POST['order'] ?? 'DESC';
        $search = $_POST['search'] ?? '';
        $search = $conn->real_escape_string($search);
        $page = isset($_POST['page']) && $_POST['page'] > 0 ? $_POST['page'] : 1;
        $start = ($page - 1) * ($limit ?? 5);

        $query="SELECT ".$tabla.".id, ".$tabla.".fecha_creacion, terceros.nombre_completo as nombre_tercero, inventario.nombre as nombre_plataforma,
                monederos.nombre as nombre_monedero, usuarios.nombre_completo as nombre_usuario, ".$tabla.".metodo_pago,
                ".$tabla.".monto, ".$tabla.".descuento, ".$tabla.".total_documento
                FROM ".$tabla."
                INNER JOIN terceros ON  ".$tabla.".id_tercero = terceros.id
                INNER JOIN inventario ON  ".$tabla.".id_inventario = inventario.id
                INNER JOIN monederos ON  ".$tabla.".id_monedero = monederos.id
                INNER JOIN usuarios ON  ".$tabla.".id_usuario = usuarios.id
               ";
        $query.=" WHERE  ".$tabla.".id_empresa = ".$id_empresa." ";
        $query.=" AND  ".$tabla.".tipo = 'venta' AND ".$tabla.".metodo_pago = 'efectivo'  AND ".$tabla.".anulado = 'no' ";

        if (!empty($search)){
            $query .= ' AND (
                      '.$tabla.'.id LIKE "%'.str_replace(' ', '%', $search).'%"
                      OR terceros.nombre_completo LIKE "%'.str_replace(' ', '%', $search).'%"
                      OR inventario.nombre LIKE "%'.str_replace(' ', '%', $search).'%"
                      )
                    ';
        }

        $result1 = $conn->query($query);
        $query .= " ORDER BY $tabla.id $order LIMIT $start, $limit";
        $result = $conn->query($query);
        $total_data = $result1->num_rows;
        $output = '<div class="col-sm-12 text-left"><label class="label label-primary">Item(s): '.$total_data.'</label></div>';
        $output.= '<table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th style="text-align: center; vertical-align: middle;">N°</th>
                                    <th style="text-align: center; vertical-align: middle;">Monedero</th>
                                    <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                    <th style="text-align: center; vertical-align: middle;">Plataforma</th>
                                    <th style="text-align: center; vertical-align: middle;">Metodo de pago</th>
                                    <th style="text-align: center; vertical-align: middle;">Monto</th>
                                    <th style="text-align: center; vertical-align: middle;">Descuento</th>
                                    <th style="text-align: center; vertical-align: middle;">Sub Total</th>
                                    <th style="text-align: center; vertical-align: middle;"><i style="font-size: 1.5em;" class="fad fa-toolbox"></i></th> 
                                </tr>
                            </thead>
                         <tbody>';
        $total_monto=0;
        $total_descuento=0;
        $total_documentos=0;
        if ($total_data > 0) {
            $result->data_seek(0); // Volver al primer resultado
            while ($row = $result->fetch_assoc()) {

                $fecha_creacion = new DateTime($row['fecha_creacion']);
                $fecha_creacion = $fecha_creacion->format('Y-m-d');
                $fecha_hoy = date('Y-m-d');
                if ($fecha_creacion == $fecha_hoy) {
                    $boton_anulacion = '<button value="'.$row['id'].'" type="button" class="anular btn btn-outline-danger"><i class="fas fa-ban"></i></button>';
                }else{
                    $boton_anulacion = '';
                }

                $output.='<tr>
                                  <td class="text-center">'.$row['id'].'</td>
                                  <td class="text-center">'.$row['nombre_monedero'].'</td>
                                  <td class="text-center">'.$row['nombre_tercero'].'</td>
                                  <td class="text-center">'.$row['nombre_plataforma'].'</td>
                                  <td class="text-center">'.$row['metodo_pago'].'</td>
                                  <td class="text-center"> $ <span class="text-success">'.money_format_decimals($row['monto']).'</span></td>
                                  <td class="text-center"> $ <span class="text-success">'.money_format_decimals($row['descuento']).'</span></td>
                                  <td class="text-center"> $ <span class="text-success">'.money_format_decimals($row['total_documento']).'</span></td>
                                  <td class="text-center">
                                      <div class="btn-group">
                                          <button value="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#modal_descripcion" type="button" class="leer btn btn-outline-info">
                                                <i class="fa fa-eye"></i>
                                          </button>
                                          '.$boton_anulacion.'
                                      </div>
                                  </td>
                               </tr>';

                $total_monto+=$row['monto'];
                $total_descuento+=$row['descuento'];
                $total_documentos+=$row['total_documento'];
            }
            $output.='<tr>
                         <td style="text-align: left;" colspan="3">Total monto: </td>
                         <td style="text-align: right;" colspan="6"> $ <span class="text-success money">'.money_format_decimals($total_monto).'</span></td>
                      </tr>';
            $output.='<tr>
                         <td style="text-align: left;" colspan="3">Total descuentos: </td>
                         <td style="text-align: right;" colspan="6"> $ <span class="text-success money">'.money_format_decimals($total_descuento).'</span></td>
                      </tr>';
            $output.='<tr>
                         <td style="text-align: left;" colspan="3">Total documentos: </td>
                         <td style="text-align: right;" colspan="6"> $ <span class="text-success money">'.money_format_decimals($total_documentos).'</span></td>
                      </tr>';
        } else {
            $output.='<tr><td colspan="100%" class="text-sm-center">Sin resultados...</td></tr>';
        }

        /* PAGINADOR */
        $total_links = ceil($total_data/$limit);
        $output.='</tbody></table><div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 center">';
        $output.= paginador($total_links, $page);
        $output.='</div>';
        echo $output;


    }
    function tabla_usuarios($conn, $connect, $id_usuario){
        /* variables */
        $tabla = "usuarios";
        $limit = $_POST['limit'] ?? 5;
        $order = $_POST['order'] ?? 'DESC';
        $search = $_POST['search'] ?? '';
        $search = $conn->real_escape_string($search);
        $page = isset($_POST['page']) && $_POST['page'] > 0 ? $_POST['page'] : 1;
        $start = ($page - 1) * ($limit ?? 5);
        /* variables (fin) */

        $query=" SELECT * FROM ".$tabla." WHERE id != ".$id_usuario." ";
        if (!empty($search)){
            $query.=' AND ('.$tabla.'.nombre_completo LIKE "%'.str_replace(' ', '%', $search).'%")';
        }

        $query.=" ORDER BY ".$tabla.".id  ".$order." ";
        $filter_query=$query.'LIMIT '.$start.', '.$limit.' ';
        $statement = $connect->prepare($query);
        $statement->execute();
        $total_data = $statement->rowCount();
        $statement = $connect->prepare($filter_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_filter_data = $statement->rowCount();
        $output = '<div class="col-sm-12 text-left"><label class="label label-primary">Item(s): '.$total_data.'</label></div>';
        $output.= '<table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th class="text-center">N°</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-images"></i></th>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Celular</th>
                                    <th class="text-center">Correo</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-toolbox"></i></th> 
                                </tr>
                            </thead>
                         <tbody>';
        if ($total_data > 0) {
            foreach ($result as $row) {

                $avatar = obtenerPrimerasDosLetras($row['usuario']);

                $output.='<tr>
                                  <td class="text-center">'.$row['id'].'</td>
                                  <td class="text-center"><div class="user-avatar"><span>'.$avatar.'</span></div></td>
                                  <td class="text-center">'.$row['usuario'].'</td>
                                  <td class="text-left">'.$row['nombre_completo'].'</td>
                                  <td class="text-center">'.$row['celular'].'</td>
                                  <td class="text-center">'.$row['correo'].'</td>
                                  <td class="text-center">
                                      <div class="btn-group">
                                          <button value="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#modal_editar_usuario" type="button" class="leer btn btn-outline-success">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                          </button>
                                          <button value="'.$row['id'].'" type="button" class="eliminar btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                      </div>
                                  </td>
                               </tr>';

            }
        } else {
            $output.='<tr><td colspan="100%" class="text-sm-center">Sin resultados...</td></tr>';
        }
        /* PAGINADOR */
        $total_links = ceil($total_data/$limit);
        $output.='</tbody></table><div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 center">';
        $output.= paginador($total_links, $page);
        $output.='</div>';
        echo $output;

    }
    function tabla_terceros($conn){
        /* variables */
        $tabla ='terceros';
        $limit = escape_post_value($conn,'limit', 5);
        $order = escape_post_value($conn,'order', 'DESC');
        $search = escape_post_value($conn,'search', '');
        $page = isset($_POST['page']) && $_POST['page'] > 0 ? $_POST['page'] : 1;
        $start = ($page - 1) * ($limit ?? 5);

        /* variables (fin) */


        $query=" SELECT * FROM ".$tabla."  ";
        if (!empty($search)){
            $query.=' WHERE ('.$tabla.'.nombre_completo LIKE "%'.str_replace(' ', '%', $search).'%")';
        }

        $result1 = $conn->query($query);
        $query .= " ORDER BY $tabla.id $order LIMIT $start, $limit";
        $result = $conn->query($query);
        $total_data = $result1->num_rows;

        $output = '<div class="col-sm-12 text-left"><label class="label label-primary">Item(s): '.$total_data.'</label></div>';
        $output.= '<table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th class="text-center">N°</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-images"></i></th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center"># Identificacion</th>
                                    <th class="text-center">Celular</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-toolbox"></i></th> 
                                </tr>
                            </thead>
                         <tbody>';
        if ($total_data > 0) {
            $result->data_seek(0); // Volver al primer resultado
            while ($row = $result->fetch_assoc()) {

                $avatar = obtenerPrimerasDosLetras($row['nombre_completo']);

                $output.='<tr>
                                  <td class="text-center">'.$row['id'].'</td>
                                  <td class="text-center"><div class="user-avatar"><span>'.$avatar.'</span></div></td>
                                  <td class="text-center">'.$row['nombre_completo'].'</td>
                                  <td class="text-left">'.$row['tipo'].'</td>
                                  <td class="text-center">'.$row['num_documento_identidad'].'</td>
                                  <td class="text-center">'.$row['celular'].'</td>
                                  <td class="text-center">
                                      <div class="btn-group">
                                          <button value="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#modal_editar_tercero" type="button" class="leer btn btn-outline-success">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                          </button>
                                          <button value="'.$row['id'].'" type="button" class="eliminar btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                      </div>
                                  </td>
                               </tr>';

            }
        } else {
            $output.='<tr><td colspan="100%" class="text-sm-center">Sin resultados...</td></tr>';
        }
        /* PAGINADOR */
        $total_links = ceil($total_data/$limit);
        $output.='</tbody></table><div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 center">';
        $output.= paginador($total_links, $page);
        $output.='</div>';
        echo $output;

    }
    function tabla_jac($conn){
        /* variables */
        $tabla ='junta_accion_comunal';
        $limit = escape_post_value($conn,'limit', 5);
        $order = escape_post_value($conn,'order', 'DESC');
        $search = escape_post_value($conn,'search', '');
        $page = isset($_POST['page']) && $_POST['page'] > 0 ? $_POST['page'] : 1;
        $start = ($page - 1) * ($limit ?? 5);

        /* variables (fin) */


        $query=" SELECT * FROM ".$tabla."  ";
        if (!empty($search)){
            $query.=' WHERE ('.$tabla.'.nombre_completo LIKE "%'.str_replace(' ', '%', $search).'%")';
        }

        $result1 = $conn->query($query);
        $query .= " ORDER BY $tabla.id $order LIMIT $start, $limit";
        $result = $conn->query($query);
        $total_data = $result1->num_rows;

        $output = '<div class="col-sm-12 text-left"><label class="label label-primary">Item(s): '.$total_data.'</label></div>';
        $output.= '<table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th class="text-center">N°</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-images"></i></th>
                                    <th class="text-center">Vereda</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Per. Juridica</th>
                                    <th class="text-center">NIT</th>
                                    <th class="text-center">RUT</th>
                                    <th class="text-center">RUC</th>
                                    <th class="text-center">Correo</th>
                                    <th class="text-center"><i style="font-size: 1.5em;" class="fad fa-toolbox"></i></th> 
                                </tr>
                            </thead>
                         <tbody>';
        if ($total_data > 0) {
            $result->data_seek(0); // Volver al primer resultado
            while ($row = $result->fetch_assoc()) {

                $avatar = obtenerPrimerasDosLetras($row['nombre_completo']);
                $img_avatar='<div class="user-avatar"><span>'.$avatar.'</span></div>';

                $output.='<tr>';
                $output.='
                          <td class="text-center">'.$row['id'].'</td>
                          <td class="text-center"></td>
                          <td class="text-center">'.$row['vereda'].'</td>
                          <td class="text-center">'.$row['nombre'].'</td>
                          <td class="text-center">'.$row['personeria_juridica'].'</td>
                          <td class="text-center">'.$row['nit'].'</td>
                          <td class="text-center">'.$row['rut'].'</td>
                          <td class="text-center">'.$row['ruc_numero'].'</td>
                          <td class="text-center">'.$row['correo'].'</td>
                          <td class="text-center">
                              <div class="btn-group">
                                  <button value="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#modal_editar_tercero" type="button" class="leer btn btn-outline-success">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                  </button>
                                  <button value="'.$row['id'].'" type="button" class="eliminar btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                              </div>
                          </td> 
                        ';
                $output.='</tr>';

            }
        } else {
            $output.='<tr><td colspan="100%" class="text-sm-center">Sin resultados...</td></tr>';
        }

        $total_links = ceil($total_data/$limit);
        $output.='</tbody></table><div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 center">';
        $output.= paginador($total_links, $page);
        $output.='</div>';
        echo $output;

    }

    /* Tablas (FIN) */






