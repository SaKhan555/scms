document.querySelector('#init_modal').onclick = function() {
    modalInit(formData, 'Add Country');  
};

function add_data(){
    let name = $('#name').val();
    $.ajax({
        url: '/admin/country',
        type: 'POST',
        data: {name:name},
    })
    .done(function(data) {
        if(data.errors){
            $('#errors').html('');
                        $.each(data.errors, function(key, value){
                             modalDismiss();
                            $('#errors').show();
                            $('#errors').append('<li class="badge badge-danger">'+value+'</li>');
                            dismiss_alert('#errors');
                        });
                    }else{
                         modalDismiss();
                            $('#success_msg').html('');
                            $('#success_msg').show();
                            $('#success_msg').append('<li class="badge badge-success">'+data.success+'</li>');
                            reload('/admin/country/reload','reload_div');
                            dismiss_alert('#success_msg');
                    }
                            })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}



// const edit_country = document.querySelectorAll('.edit_country');
// for (let i = 0; i < edit_country.length; i++) {
//     edit_country[i].onclick = function() {
//         var id = $(this).attr('data-id');
//         modalInit(id, id);

//     };
// }
    $(document).on("click", ".btn_edit", function(event){
  let country_id = $(this).attr('data-id');
  $.ajax({
      url: '/admin/country/'+country_id+'/edit/',
      type: 'GET',
      data: {id:country_id},
  })
  .done(function(response) {
        modalInit(response.edit_html, 'Edit Country');  
  });
});

$(document).on("click", "#btn_update", function(event){
  let edit_country_ele = $('#edit_name');
let name = edit_country_ele.val();
let country_id = edit_country_ele.attr('data-id');
  $.ajax({
      url: '/admin/country/update',
      type: 'PUT',
      data: {id:country_id,name:name},
  })
  .done(function(response_data) {
        if(response_data.errors){
                        $.each(response_data.errors, function(key, value){
                             modalDismiss();
                            $('#errors').html('');
                            $('#errors').show();
                            $('#errors').append('<li class="badge badge-danger">'+value+'</li>');
                            dismiss_alert('#errors');
                        });
                    }else{
                         modalDismiss();
                            $('#success_msg').html('');
                            $('#success_msg').show();
                            $('#success_msg').append('<li class="badge badge-success">'+response_data.success+'</li>');
                            reload('/admin/country/reload','reload_div');
                            dismiss_alert('#success_msg');
                    } 
  });
});

 $(document).on("click", ".btn_delete", function(event){
  let country_id = $(this).attr('data-id');
        modalInit(delete_data, 'Delete Country');  
        var btn_delete = $('#btn_delete');
btn_delete.click(function() {
$.ajax({
      url: '/admin/country/delete',
      type: 'Delete',
      data: {id:country_id},
  })
  .done(function(response_data) {
  if(response_data.success){
reload('/admin/country/reload','reload_div');
    modalDismiss();
     $('#success_msg').html('');
    $('#success_msg').show();
    $('#success_msg').append('<li class="badge badge-success">'+response_data.success+'</li>');
    dismiss_alert('#success_msg');
  }
  });
});
});
