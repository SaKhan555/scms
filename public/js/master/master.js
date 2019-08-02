// modal funtion
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addDataWithAjax(data_url,data_obj,error_msg_div,success_msg_div,reload_url,div_to_reload){
    $('#loading').css('display', 'block');
    $.ajax({
        url: data_url,
        type: 'POST',
        dataType:'json',
        data:data_obj,//data:{param:value,},
        enctype: 'multipart/form-data',
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
    }).done(function(response_data) {
        modalDismiss();
        if(response_data.length != 0 || response_data != null || response_data != "" ){
            if(response_data.errors){
                $(error_msg_div).html('');
                $.each(response_data.errors, function(key, value){
                    errorBoxToggle(error_msg_div,value,dismissAlert);
                });
            } else {
                    reload(reload_url,div_to_reload);
                    successBoxToggle(success_msg_div,response_data.success,dismissAlert);
            }
        } else {
            modalInit(response_data,'Error!');
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#loading').css('display', 'none');
    });
}

function editFormWithAjax(url,send_data_obj,modal_title){
$.ajax({
    url: url,   // abc/id/edit
    type: 'POST',
    data:send_data_obj,
})
.done(function(response) {
    if(response.success){
        modalInit(response.edit_html, modal_title);  
 
    }else{
        modalInit(`<h6 class='alert alert-danger'>Something went wrong try Again</h6><hr />`,`Error <i class="fas fa-exclamation-triangle"></i>`);  
    }
});
}

function updateDataWithAjax(data_url,data_obj,error_msg_div,success_msg_div,reload_url,div_to_reload){
    $('#loading').css('display', 'block');
    $.ajax({
        url: data_url,
        type:"POST",
        dataType:'json',
        data:data_obj,//data:{param:value,},
        enctype: 'multipart/form-data',
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
    }).done(function(response_data) {
        modalDismiss();
        if(response_data.length != 0 || response_data != null || response_data != "" ){
            if(response_data.errors){
                $(error_msg_div).html('');
                $.each(response_data.errors, function(key, value){
                    errorBoxToggle(error_msg_div,value,dismissAlert);
                });
            } else {
                    reload(reload_url,div_to_reload);
                    successBoxToggle(success_msg_div,response_data.success,dismissAlert);
            }
        } else {
            modalInit(response_data,'Error!');
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#loading').css('display', 'none');
    });
}
function deleteDataWithAjax(data_object,url,reload_url,reload_div)
{
    $.ajax({
          url: url,
          type: 'Delete',
          data: data_object,
      })
      .done(function(response_data) {
      if(response_data.success){
        modalDismiss();
        reload(reload_url,reload_div);
         $('#success_msg').html('');
        $('#success_msg').show();
        $('#success_msg').append(`<li class="badge badge-success">${response_data.success}</li>`);
        dismissAlert('#success_msg');
      }
      });
}
function viewDataWithAjax(url,data_obj,title){
    $.ajax({
        url: url,   // abc/id/edit
        type: 'POST',
        data:data_obj,
    })
    .done(function(response) {
        if(response.success){
            modalInit(response.html, title);  
        }else{
            modalInit(`<h6 class='alert alert-danger'>Something went wrong try Again</h6><hr />`,`Error <i class="fas fa-exclamation-triangle"></i>`);  
        }
    });
    }

var delete_data = `
<div class="col-md-12">
<h6 class="text-center text-danger" style="margin-bottom: 20px;">Are you sure to Delete this?</h6>
<div class="row" style="border-bottom:1px solid #e4e4e4;"></div>
<div class="float-right mt-2 mb-2">
<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button>
<button type="button" class="btn btn-success btn-sm" id="btn_delete">Delete</button>
</div>
</div>`;

function modalInit(data, title) {
    $("#masterModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#modal-title").html(title);
    document.querySelector('#modal-body').innerHTML = data; 
}

function modalDismiss(){
    $('#masterModal').modal('toggle');
    $('.modal-backdrop').removeClass('modal-backdrop');
}

function reload(url,response_div)
{
    if( url == "" || response_div == "" || response_div == "undefined") {
        modalInit(`<h6 class='alert alert-danger'>URL and Response Div is required.!</h6><hr />`,`Error <i class="fas fa-exclamation-triangle"></i>`);  
        return;
    }
    $.ajax({
        url: url,
        type: 'post',
    })
    .done(function(response) {
        document.getElementById(response_div).innerHTML = response.html;
    });    
}

function fieldsValidation(btn,fields = array()) {
    for (var i = 0; i < fields.length; i++) {
        if(fields[i].val() == "" ||fields[i].val() == "undefined" ||fields[i].val() == null){
            $(btn).html(`Add City <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span>
            </div>`);
        }
    }
}

function errorBoxToggle(message_box_element,error_message,callback)
{
    $(message_box_element).show();
    $(message_box_element).append(`<li class="badge badge-danger">${error_message}</li>`);
    callback(message_box_element);
}

function successBoxToggle(message_box_element,success_message,callback)
{
    $(message_box_element).html('');
    $(message_box_element).show();
    $(message_box_element).append(`<li class="badge badge-success">${success_message}</li>`);
    callback(message_box_element);
}

function dismissAlert(element){
    $(element).fadeTo(2000, 500).slideUp(500, function() {
    $(element).slideUp(500);
    });
}

function requireElements(elements = array())
{
    let error_message = '';
    for(let i = 0; i < elements.length; i++) {
        if(elements[i].val() == "" || elements[i].val() == null){
            error_message += elements[i].attr('name').toUpperCase() + ' field is required. <br />';
        }
    }
    if(error_message != "") {
        modalInit(`<p class='alert alert-danger'>${error_message}</p>`,'Error!');
        return true;
    }
}
