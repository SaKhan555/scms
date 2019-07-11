document.querySelector('#init_modal').onclick = function() {
    modalInit(formData, 'Add new Warehouse');
};


// const edit_country = document.querySelectorAll('.edit_country');
// for (let i = 0; i < edit_country.length; i++) {
//     edit_country[i].onclick = function() {
//         var id = $(this).attr('data-id');
//         modalInit(id, id);

//     };
// }


 function getCities() {
     let country_id = document.querySelector('#country').value;
    $.ajax({
            url: '/admin/warehouse/getCities',
            type: 'POST',
            dataType: 'script',
            data: { country_id,country_id },
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

