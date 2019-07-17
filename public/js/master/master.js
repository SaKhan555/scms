// modal funtion
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addDataWithAjax(data_url,data_obj,error_msg_div,success_msg_div,reload_url,div_to_reload){
    $.ajax({
        url: data_url,
        type: 'POST',
        dataType:'json',
data:data_obj,//data:{param:value,},
enctype: 'multipart/form-data',
processData: false,  // tell jQuery not to process the data
contentType: false,   // tell jQuery not to set contentType
})
    .done(function(response_data) {
        modalDismiss();
        if(response_data.length != 0 || response_data != null || response_data != "" ){
            if(response_data.errors){
                $(error_msg_div).html('');
                $.each(response_data.errors, function(key, value){
                    $(error_msg_div).show();
                    $(error_msg_div).append(`<li class="badge badge-danger">${value}</li>`);
                    dismiss_alert(error_msg_div);
                });
            }else{
                reload(reload_url,div_to_reload);
                $(success_msg_div).html('');
                $(success_msg_div).show();
                $(success_msg_div).append(`<li class="badge badge-success">${response_data.success}</li>`);
                dismiss_alert(success_msg_div);
            } 
        }else{
            console.log(response_data);
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}

function editFormWithAjax(url_with_id,send_data_obj,modal_title){
$.ajax({
    url: url_with_id,   // abc/id/edit
    type: 'GET',
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


var delete_data = `
<div class="col-md-12">
<h6 class="text-center text-danger" style="margin-bottom: 20px;">Are you sure to Delete this?</h6>
<div class="row" style="border-bottom:1px solid #e4e4e4;"></div>
<div class="float-right mt-2">
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

function reload(url,response_div){
    if(url.length == 0 || url == "" || response_div.length == 0 || response_div == "" || response_div == "undefined"){
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

function dismiss_alert(class_div_to_remove){
    $(class_div_to_remove).fadeTo(2000, 500).slideUp(500, function() {
    $(class_div_to_remove).slideUp(500);
    });
}
