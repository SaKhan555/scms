document.querySelector('#country').onchange = function() {
    let country_id = $(this).val();
    $.ajax({
            url: '/admin/customer/getCities',
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

 function print_doc(print_target) {

    //Get the HTML of div
    var divElements = document.getElementById(print_target).innerHTML;
    
    newpage = window.open('', '_blank');
    
    data = "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>";
    data1 = "<link href='http://127.0.0.1:8000/template/vendor/fontawesome-free/css/all.min.css' rel='stylesheet'>";
    data2 = '<link href="http://127.0.0.1:8000/template/css/sb-admin.css" media="screen" rel="stylesheet">';
     data3 = '<link href="http://127.0.0.1:8000/template/css/print.css" media="print" rel="stylesheet">';
    var script = newpage.document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.innerHTML = "setInterval(function(){ window.print(); window.close(); }, 1000);";

    var style = newpage.document.createElement('link');
    style.setAttribute('type', 'text/css');

    newpage.document.body.innerHTML =  data+data1 + data2+data3 + divElements;
    newpage.document.body.appendChild(script);
    newpage.document.body.appendChild(style);
}
