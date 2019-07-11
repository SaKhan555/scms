document.querySelector('#init_modal').onclick = function() {
    modalInit(formData, 'Add City');
};

$(document).on("click", "#btn_add", function(event){
    let country_id = $('#country').val();
    let city_name = $('#name').val();
    if(country_id == "" || city_name == ""){
        modalInit("<h5 class='text-danger'>All fields are required</h5><hr />", 'Error!');
        return;
    }
    $.ajax({
        url: '/admin/city',
        type: 'POST',
        data: {country_id:country_id,name:city_name},
    })
    .done(function(response_data) {
        if(response_data.errors){
            $('#errors').html('');
            $.each(response_data.errors, function(key, value){
                modalDismiss();
                $('#errors').show();
                $('#errors').append('<li class="badge badge-danger">'+value+'</li>');
                dismiss_alert('#errors');
            });
        }else{
            modalDismiss();
            $('#success_msg').html('');
            $('#success_msg').show();
            $('#success_msg').append('<li class="badge badge-success">'+response_data.success+'</li>');
            reload('/admin/city/reload','reload_div');
            dismiss_alert('#success_msg');
        } 
    });
});
