// modal funtion
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function modalInit(setData, title) {
    $("#masterModal").modal({
    backdrop: 'static',
    keyboard: false
    });
    
    $("#modal-title").html(title);
    document.querySelector('#modal-body').innerHTML = setData;
    
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
