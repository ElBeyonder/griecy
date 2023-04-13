$(document).ready(function () {

    let url = 'login/infra/login.php';

    function login() {

        let form_data = new FormData(this);

        $.ajax({
            url:url,
            method:'POST',
            dataType:'JSON',
            cache:false,
            processData:false,
            contentType:false,
            data:form_data
        })
            .done(r=>{
                switch (r) {
                    case 'login_exito':
                        let link_general = $('#link_general').val();
                        window.location.href = link_general+"admin/usuarios/";
                        toastr.success('Inicio de sesión exitoso', '¡Bienvenido!');
                        break
                    case 'password_incorrecta':
                        toastr.error('Contraseña incorrecta', 'Error de inicio de sesión');
                        break
                    case 'user_no_encontrado':
                        toastr.warning('Usuario no encontrado', 'Error de inicio de sesión');
                        break
                    default:
                        console.info('Respuesta: ',r);
                }
            })
            .fail(r=>{
                toastr.error('Ha ocurrido un error inesperado', 'Error');
                console.info('Error: ',r);
            })
            .always(r=>{
                $('#password').val('');
            })
    }

    $(document).on('submit', '#form_login', login);

});


