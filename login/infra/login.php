<?php
    require_once '../../admin/config/config.php';

    if (isset($_POST['usuario'])){
        $usuario  = $conn->real_escape_string($_POST['usuario']);
        $usuario  = htmlspecialchars($_POST['usuario']);
        $usuario  = htmlentities($_POST['usuario']);
        $usuario  = addslashes($_POST['usuario']);
    }

    if (isset($_POST['password'])){
        $password = $conn->real_escape_string($_POST['password']);
        $password = htmlspecialchars($_POST['password']);
        $password = htmlentities($_POST['password']);
        $password = addslashes($_POST['password']);
    }

    $sql=" SELECT id, password FROM usuarios WHERE usuario='".$usuario."' OR correo='".$usuario."'  ;";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])){

            session_start();
            $_SESSION['login'] = 'login';
            $_SESSION['u_id'] = $row['id'];
            $output='login_exito';

        }else{
            $output='password_incorrecta';
        }
    } else {
        $output='user_no_encontrado';
    }
    echo json_encode($output);
    $conn->close();



