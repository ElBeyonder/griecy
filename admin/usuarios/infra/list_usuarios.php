<?php
    session_start();
    require_once '../../config/config.php';


    $sql = "SELECT * FROM usuarios ";
    $result = mysqli_query($conn, $sql);

    $response = array();
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            "id" => $row["id"],
            "imagen" => '',
            "nombre_completo" => $row["nombre_completo"],
            "celular" => $row["celular"],
            "correo" => $row["correo"],
            "direccion_fisica" => $row["direccion_fisica"],
            "tipo_usuario" => $row["tipo_usuario"],
        );
    }
    $response["data"] = $data;
    mysqli_close($conn);
    echo json_encode($response);








