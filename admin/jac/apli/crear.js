$(document).ready(function () {

    let url = 'infra/jac.php';

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

    function agregar() {

        let formData = new FormData(this);
        formData.append('opcion',1);

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
                                $('#form_agregar_tercero')[0].reset();
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



    $(document).on('submit', '#form_agregar', agregar);
});


