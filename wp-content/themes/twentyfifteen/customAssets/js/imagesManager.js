/**
 * Created by chadsfather on 4/6/15.
 */
var imagesManager = (function($, _, gapi) {
    function getOAuth()
    {
        gapi.auth.authorize({
                'client_id': CLIENT_ID,
                'scope': SCOPES,
                'immediate': true},
                handleAuthResult);
    }

    function handleAuthResult(authResult)
    {
        if (authResult) {
            gapi.client.load('drive', 'v2', function() {
                var request = gapi.client.request({
                    'path': '/drive/v2/files',
                    'method': 'GET',
                    'params': {
                        'q': '"0B6cc8HdeC7MqfnkydHlhSFZlbWxzX3hWSk1WdGtjTkFYZ1dEc1BmVmJOVlhvb0VxNkF2ZTQ" in parents and mimeType contains "image/jpeg"'
                    }
                });

                request.execute(function(resp) {
                    console.log(resp);
                    var images = _.reject(resp.items, function(obj) {
                        return obj.explicitlyTrashed
                    });

                    render(images);
                });
            });
        }

        else {
            getOAuth()
        }
    }

    function render(images)
    {
        var container = {
            images: images
        };

        var templateCompilado = _.template($('#gallery').html());

        $('#myCarousel').html(templateCompilado(container));
        setTimeout(function() {
            $('.carousel').carousel()
        }, 10000);
    }

    return {
        init: function() {
            getOAuth();
        }
    }
})(jQuery, _, gapi);