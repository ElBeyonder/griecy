$(document).ready(function () {

    let url = 'infra/usuarios.php';

    init();
    function init() {
        $('.js-select2').select2();
        $('.dropify').dropify({
            messages: {
                'default': 'Arrastra y suelta un archivo aquí o haz clic',
                'replace': 'Arrastra y suelta o haz clic para reemplazar',
                'remove': 'Eliminar',
                'error': 'Oops, algo salió mal.'
            },
            error: {
                'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
                'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
                'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
                'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
                'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
                'imageFormat': 'El formato de la imagen no está permitido (solo {{ value }}).'
            }

        });
        $(".date-input").flatpickr({
            defaultDate: "today",
            locale: "es",
            dateFormat: "Y-m-d",
        });
    }

    lista(1);
    function lista(page) {

        let search = $('#search').val();

        $.ajax({
            url:url,
            method:'post',
            data:{
                opcion:4,
                page:page,
                search:search,
            }
        })
            .done(function (r) {
                $('#content_result_items').html(r);
            })
            .fail(function (f) {
                console.info(f);
            })
    }
    $(document).on('click', '.page-link', function () {
        let page = $(this).data('page');
        lista(page);
    });
    $(document).on('keyup', '#search', function () {
        lista(1);
    });


    function agregar_usuarios() {

        let formData = new FormData(this);
        formData.append('opcion',1);

        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();

        if (password != confirm_password) {
            toastr.error('Las contraseñas no coinciden');
            $("#confirm_password").val("");
        }else{
            Swal.fire({
                title: '¿Esta segur@?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'NO',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url:url,
                        method:'post',
                        dataType:'json',
                        data:formData,
                        cache:false,
                        processData:false,
                        contentType:false,
                        beforeSend:function () {

                        }
                    })
                        .done((r)=> {
                            switch (r) {
                                case 'r':
                                    $('#form_agregar_usuarios')[0].reset();
                                    break;
                                case 'e':

                                    break;
                                default:
                                    console.info('Resultado: ',r);
                            }
                        })
                        .fail((f)=> {
                            console.info('Error:',f);
                        })
                        .always((a)=> {
                            lista(1);
                            init();
                        })
                }
            });
        }
    }
    function eliminar_usuarios() {

        let id = $(this).val();

        Swal.fire({
            title: '¿Esta segur@?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI',
            cancelButtonText: 'NO',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url:url,
                    method:'post',
                    dataType:'json',
                    data:{
                        opcion:2,
                        id:id
                    },
                })
                    .done((r)=> {
                        switch (r) {
                            case '':
                                break;
                            case 'e':
                                break;
                            default:
                                console.info('Resultado: ',r);
                        }
                    })
                    .fail((f)=> {
                        console.info('Error:',f);
                    })
                    .always((a)=> {
                        lista(1);
                        init();
                    })
            }
        });
    }
    function leer_usuarios() {

        let id = $(this).val();

        $.ajax({
            url:url,
            method:'post',
            dataType:'json',
            data:{
                opcion:3,
                id:id
            },
        })
            .done((r)=> {
                let res = r[0];

                $('#id_editar_usuario').val(res.id);
                $('#nombre_competo_editar').val(res.nombre_completo);
                $('#usuario_editar').val(res.usuario);
                $('#celular_editar').val(res.celular);
                $('#correo_editar').val(res.correo);
                $('#direccion_fisica_editar').val(res.direccion_fisica);
                $('#tipo_usuario_editar').val(res.tipo_usuario);
            })
            .fail((f)=> {
                console.info('Error:',f);
            })
            .always((a)=> {
                init();
            })
    }
    function editar_usuarios() {

        let formData = new FormData(this);
        formData.append('opcion',5);

        Swal.fire({
            title: '¿Esta segur@?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI',
            cancelButtonText: 'NO',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url:url,
                    method:'post',
                    dataType:'json',
                    data:formData,
                    cache:false,
                    processData:false,
                    contentType:false,
                    beforeSend:function () {

                    }
                })
                    .done((r)=> {
                        switch (r) {
                            case '':
                                toastr.success('Usuario editado');
                                break;
                            case 'e':
                                toastr.success('Error, al editar el usuario.');
                                break;
                            default:
                                console.info('Resultado: ',r);
                        }
                    })
                    .fail((f)=> {
                        console.info('Error:',f);
                    })
                    .always((a)=> {
                        lista(1);
                        init();
                    })
            }
        });
    }

    $(document).on('submit', '#form_agregar_usuarios', agregar_usuarios);
    $(document).on('submit', '#form_editar_usuario', editar_usuarios);
    $(document).on('click', '.eliminar', eliminar_usuarios);
    $(document).on('click', '.leer', leer_usuarios);

});


