$(document).ready(function () {

    let url = 'infra/concursos.php';

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
            didOpen: () => {
                setTimeout(() => {
                    const confirmButton = document.querySelector('.swal2-confirm');
                    if (confirmButton) {
                        confirmButton.focus();
                    }
                }, 100);
            }
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
                                toastr.success('Item agregado correctamente...');
                                $('#form_agregar_item')[0].reset();
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
    function eliminar() {

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
    function leer() {

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
                let link_general = $('#link_general').val();
                $('#id_item').val(res.id);
                $('#nombre').val(res.nombre);
                $('#codigo').val(res.codigo);
                $('#version').val(res.version);
                $('#fecha_inicio').val(res.fecha_inicio);
                $('#fecha_fin').val(res.fecha_fin);
                $('#estado').val(res.estado);
                const doc =
                    '<label>Imagen del documento de identidad</label>' +
                    '<input type="file" class="dropify" name="doc_convocatoria"' +
                    (res.doc_convocatoria ? ` data-default-file="${link_general}admin/concursos/dom/img/${res.doc_convocatoria}"` : '') +
                    '>';
                $('#content_input_file').html(doc);
            })
            .fail((f)=> {
                console.info('Error:',f);
            })
            .always((a)=> {
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
                    locale: "es",
                    dateFormat: "Y-m-d",
                });

            })
    }
    function actualizar() {

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
                                toastr.success('tercero editado');
                                break;
                            case 'e':
                                toastr.success('Error, al editar el tercero.');
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


    $(document).on('submit', '#form_agregar_item', agregar);
    $(document).on('submit', '#form_actualizar_item', actualizar);
    $(document).on('click', '.leer', leer);
    $(document).on('click', '.eliminar', eliminar);

});


