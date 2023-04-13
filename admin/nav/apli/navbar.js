$(document).ready(function () {




    $(document).on('click', '#salir', eliminar_session);

});

    const eliminar_session = () => {

        let link_general = $('#link_general').val();
        let url = link_general+'admin/nav/infra/navbar.php';

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data:{
                opcion:1
            }
        })
            .done(result => {
                if (result == "done") {
                    window.location.href = link_general;
                }
            });
    }

