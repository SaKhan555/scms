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


var delete_data = `
<div class="col-md-12">
<h6 class="text-center text-danger" style="margin-bottom: 20px;">Are you sure to Delete this?</h6>
<div class="row" style="border-bottom:1px solid #e4e4e4;"></div>
<div class="float-right mt-2">
<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button>
<button type="button" class="btn btn-success btn-sm" id="btn_delete">Delete</button>
</div>
</div>`;

function modalInit(dataToShow, title) {
    $("#masterModal").modal({
    backdrop: 'static',
    keyboard: false
    });
    
    $("#modal-title").html(title);
    document.querySelector('#modal-body').innerHTML = dataToShow; 
}
function modalDismiss(){
$('#masterModal').modal('toggle');
$('.modal-backdrop').removeClass('modal-backdrop');
}

function reload(url,response_div){
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
