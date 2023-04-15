$(document).ready(function () {

    let url = 'infra/jac.php';

    init();
    function init() {
        $('.js-select2').select2();
        $('#vereda').select2({
            dropdownParent: $('#modal_agregar_item')
        });
        $('#cargo').select2({
            dropdownParent: $('#modal_agregar_tercero')
        });
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
        let limit = $('#limit').val();
        let order = $('#order').val();
        let vereda = $('#vereda_filtro').val();

        $.ajax({
            url:url,
            method:'post',
            data:{
                opcion:6,
                page:page,
                limit:limit,
                order:order,
                search:search,
                vereda:vereda,
            }
        })
            .done((r)=>{
                $('#content_result_items').html(r);
            })
            .fail(function(f){
                console.info('Error: ',f);
            })
    }
    $(document).on('click', '.page-link', function () {
        let page = $(this).data('page');
        lista(page);
    });
    $(document).on('keyup', '#search', function () {
        lista(1);
    });
    $(document).on('change', '#vereda_filtro, #limit, #order', function () {
        lista(1);
    });

    function agregar_jac() {

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
                                toastr.success('Jac agregado correctamente..');
                                $('#form_agregar_jac')[0].reset();
                                break;
                            case 'e':
                                toastr.warning('No se pudo agregar el item..');
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
    function agregar_tercero() {

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
                            case 'r':
                                toastr.success('Tercero agregado correctamente..');
                                $('#form_agregar_tercero')[0].reset();
                                break;
                            case 'e':
                                toastr.warning('No se pudo agregar el item..');
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
                                toastr.success('Item eliminado');
                                break;
                            case 'e':
                                toastr.error('Error al eliminar item');
                                break;
                            default:
                                toastr.warning('Proceso terminado con posibles errores');
                                console.info('Resultado: ',r);
                        }
                    })
                    .fail((f)=> {
                        toastr.error('Error al eliminar item');
                        console.info('Error:',f);
                    })
                    .always((a)=> {
                        lista(1);
                        init();
                    })
            }
        });
    }
    function item_add_tercero() {
        let id = $(this).val();
        $('#id_jac_agregar_tercero').val(id);
    }

    $(document).on('submit', '#form_agregar_jac', agregar_jac);
    $(document).on('submit', '#form_agregar_tercero', agregar_tercero);
    $(document).on('click', '.eliminar', eliminar);
    $(document).on('click', '.add-tercero', item_add_tercero);

});





