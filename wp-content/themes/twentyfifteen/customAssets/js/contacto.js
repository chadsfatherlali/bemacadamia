/**
 * Created by chadsfather on 5/6/15.
 */
(function($, _) {
    $form = $('#form-contact');

    $form.validate({
        submitHandler: function(form) {
            send($form.serialize());
        },
        rules: {
            name: {
                required: true
            },
            tel: {
                number: true,
                minlength: 9
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            tel: {
                number: 'Este cmapo solo adminte números.',
                minlength: 'Por favor introduzaca 9 número como míØnimo.'
            }
        }

    });

    function send(info) {
        $.get(
            '/vendor/mailmanager/mailmanager.php',
            info,
            function(response) {
                if(response.success) {
                    $form.trigger("reset");
                    $('#success').show('fast');
                }

                else {
                    $('#error').show('fast');
                }

                setTimeout(function() {
                    $('#success, #error').hide('fast');
                }, 5000);
            }
        );
    }
})(jQuery, _);