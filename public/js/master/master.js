// modal funtion
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
