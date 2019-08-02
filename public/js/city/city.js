$( document ).ready(function() {

document.querySelector('#init_modal').onclick = function() {
    modalInit(formData, 'Add City');
};

$(document).on("click", "#btn_add", function(event){
      fieldsValidation("#btn_add",[$('#country'),$('#name')]);
    let country_id = $('#country').val();
    let city_name = $('#name').val();

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
                $('#errors').append(`<li class="badge badge-danger">${value}</li>`);
                dismissAlert('#errors');
            });
        }else{
            modalDismiss();
            $('#success_msg').html('');
            $('#success_msg').show();
            $('#success_msg').append('<li class="badge badge-success">'+response_data.success+'</li>');
            reload('/admin/city/reload','reload_div');
            dismissAlert('#success_msg');
        } 
    });
});

    $(document).on("click", ".btn_edit", function(event){
  let city_id = $(this).attr('data-id');
  $.ajax({
      url: `/admin/city/${city_id}/edit/`,
      type: 'GET',
      data: {id:city_id},
  })
  .done(function(response) {
    if(response.success){
        modalInit(response.edit_html, 'Edit City');  
    }else{
        modalInit(`<h6 class='alert alert-danger'>Something went wrong try Again</h6><hr />`,
                 `Error <i class="fas fa-exclamation-triangle"></i>`);  
    }
  });
});

$(document).on("click", "#btn_update", function(event){
  let e_city_ele = $('#name');
let name = e_city_ele.val();
let city_id = e_city_ele.attr('data-id');
let country_id = $('#country').val();
  $.ajax({
      url: '/admin/city/update',
      type: 'PUT',
      data: {id:city_id,country_id:country_id,name:name},
  })
  .done(function(response_data) {
        if(response_data.errors){
                         $('#errors').html('');
                        $.each(response_data.errors, function(key, value){
                             modalDismiss();
                            $('#errors').show();
                            $('#errors').append(`<li class="badge badge-danger">${value}</li>`);
                            dismiss_alert('#errors');
                        });
                    }else{
                         modalDismiss();
                            $('#success_msg').html('');
                            $('#success_msg').show();
                            $('#success_msg').append(`<li class="badge badge-success">${response_data.success}</li>`);
                            reload('/admin/city/reload','reload_div');
                            dismiss_alert('#success_msg');
                    } 
  });
});
 $(document).on("click", ".btn_delete", function(event){
  let city_id = $(this).attr('data-id');
        modalInit(delete_data, 'Delete City');  
        var btn_delete = $('#btn_delete');
btn_delete.click(function() {
$.ajax({
      url: '/admin/city/delete',
      type: 'Delete',
      data: {id:city_id},
  })
  .done(function(response_data) {
  if(response_data.success){
reload('/admin/city/reload','reload_div');
    modalDismiss();
     $('#success_msg').html('');
    $('#success_msg').show();
    $('#success_msg').append(`<li class="badge badge-success">${response_data.success}</li>`);
    dismissAlert('#success_msg');
  }
  });
});
});


});
