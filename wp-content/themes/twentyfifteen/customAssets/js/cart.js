/**
 * Created by chadsfather on 10/6/15.
 */
(function($) {
    precioTotal:
    {
        calculatePrecios();
        function calculatePrecios() {
            var incremento = 4;
            var precios = $('.precios');
            var total = 0;

            function parseToFloat(precio) {
                var p = precio.replace(',', '.');
                p = parseFloat(p);

                return p;
            }

            $.each(precios, function (k, v) {
                total = total + parseToFloat($(v).html());
            });

            if(total == 0) {
                incremento = 0;
                window.top.location = '/shop';
            }

            $('#full-total').html((total + incremento).toString().replace('.', ',') + '€');
            $('#sub-total').html(total.toString().replace('.', ',') + '€');
        }

    }

    toTrahs:
    {
        $('.toTrash').on('click', function() {
            var id = $(this).attr('data-trash');

            $.post('/vendor/cart/cart.php?accion=delete', {accion: 'delete', id: id, hash: $.cookie('cart')}, function(response) {
                if(response == 'ko') {
                    alert('Se ha producido un error');
                }

                else {
                    $('#producto-info-' + id).remove();

                    setTimeout(function() {
                        countProducts(response);
                        calculatePrecios();
                    }, 500);
                }
            });
        });
    }

    count:
    {
        function countProducts(obj) {
            var total = 0;

            $.each(obj, function(k, v) {
                total = ~~total + ~~v.cantidad;
            });

            $('#total-cesta-prodcutos').html(total);
        }
    }

    editarbutton: {
        $('#editar-info').on('click', function() {
            $('.payment-method-1, .payment-method-2').removeClass('next');
        })
    }

    validate:
    {
        $form = $('#form-compra-datos-usuario');
        $form.validate({
            submitHandler: function(form) {
                $('.payment-method-1').addClass('next');
                $('.payment-method-2').addClass('next');

                var datos = serialToObject();

                $('#nombre-edit').html(datos.nombre);
                $('#apellido-edit').html(datos.apellido);
                $('#email-edit').html(datos.email);
                $('#direccion-edit').html(datos.direccion);
                $('#cpostal-edit').html(datos.cpostal);
                $('#ciudad-edit').html(datos.ciudad);
                $('#telefono-edit').html(datos.telefono);
            },
            ignore: [],
            rules: {
                email: {
                    required: true,
                    email: true
                },
                nombre: {
                    required: true,
                    minlength: 4
                },
                apellido: {
                    required: true,
                    minlength: 4
                },
                direccion: {
                    required: true
                },
                ciudad: {
                    required: true
                },
                cpostal: {
                    required: true,
                    number: true,
                    minlength: 5
                },
                telefono: {
                    number: true,
                    minlength: 9
                }
            },
            messages: {
                email: {
                    required: 'Es necesario que introduzca un email',
                    emai: 'Por favor revise su email ej: ejemplo@dominio.com'
                },
                nombre: {
                    required:'Por favor introduzca su nombre',
                    minlength: 'Por favor introduzca un nombre válido'
                },
                apellido: {
                    required:'Por favor introduzca su nombre',
                    minlength: 'Por favor introduzca un apellido válido'
                },
                direccion: {
                    required: 'Por favor introduzca una dirección'
                },
                ciudad: {
                    required: 'Por favor introduzca una ciudad'
                },
                cpostal: {
                    required: 'Por favor introduzca su código postal',
                    number: 'Solo se admite números',
                    minlegth: 'El código postal debe tener como mínimo 5 números'
                },
                telefono: {
                    number: 'Solo se admite números',
                    minlength: 'El número de teléfono debe constar de 9 números'
                }
            }
        });
    }

    doPayment: {
        $('#doPayment').on('click', function() {
            $pagos = $('.pagos');
            if(!$pagos.is(':checked')) {
                $('#modal-pago3').modal('show');
            }

            else {
                var $pago1 = $('#pago1');
                var $pago2 = $('#pago2');

                var datos = serialToObject();
                    datos.pago = $pago1.is(':checked')? $pago1.val() : $pago2.val();
                    datos.hash = $.cookie('cart');

                $.post('/vendor/pagos/pagos.php', datos, function(response) {
                    if(response == 'ok') {
                        $('#modal-pago4').modal('show');
                        $.removeCookie('cart', {
                            path: '/',
                            domain : host
                        });

                        setTimeout(function() {
                            window.top.location = '/';
                        }, 5000);
                    }
                    else {
                        alert('Se ha producido un error.');
                    }
                });
            }
        });
    }

    function serialToObject()
    {
        var obj = {};
        var datos = $('#form-compra-datos-usuario').serializeArray();

        $.each(datos, function(k, v) {
            obj[v.name] = v.value;
        })

        return obj;
    }
})(jQuery);