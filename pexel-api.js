/* GALLERY START */

$(document).ready(function() {
    var api_key = "2yYFECDQGdXit2y1BQiMK2pmrvt4tc5YRVEnhsS9VuTyg0yMuuCzq1Im";
    var search;
    var image = '';

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    var searchParam = getParameterByName('searchAnimal');
    if (searchParam) {
        $("#speechToText").val(searchParam);
        imageSearch(searchParam);
    }

    $("#form").submit(function() {
        search = $("#speechToText").val();
        imageSearch(search);
    });

    $('#form').on('keyup', function(y) {
        if (y.keyCode === 13) {
            imageSearch(search);
        }
    });

    function imageSearch(search) {
        $('#gallery-animal').html('');
        $('#galleryVideo-animal').html('');

        $.ajax({
            method: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", api_key);
            },
            url: "https://api.pexels.com/v1/search?query=" + search + "&per_page=9&page=1",
            success: function(data) {
                data.photos.forEach(photo => {
                    image = `
                    <img src="${photo.src.original}" height="350" class="p-2" style="border-radius: 12%;"/>`;

                    $("#gallery-animal").append(image);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});

/* GALLERY END */