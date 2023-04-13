<?php
    require_once '../../config/config.php';
    $opcion = $_POST['opcion'];




    switch ($opcion){
        case 1:
            $eliminar_session = eliminar_sesiones();
            echo json_encode($eliminar_session);
            break;
    }






