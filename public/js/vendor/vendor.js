document.querySelector('#country').onchange = function() {
    let country_id = $(this).val();
    $.ajax({
            url: '/admin/vendor/getCities',
            type: 'POST',
            dataType: 'script',
            data: { country_id, country_id },
        })
        .done(function(response) {
            $('#city').html('');
            let getCities = $.parseJSON(response);
            if (getCities.length > 0) {
                for (var i = getCities.length - 1; i >= 0; i--) {
                    $('#city').append('<option value="' + getCities[i].id + '">' + getCities[i].name + '</option>');
                }
            } else {
                $('#city').append('<option selected disabled>Data not found.!</option>');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
    });
}
