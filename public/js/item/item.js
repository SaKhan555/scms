document.querySelector('#init_modal').onclick = function() {
    modalInit(formData, 'Add new Item');
};
$(document).on('click','#btn_add',function(){
let item_category = $('#item_category').val();
let item_name = $('#name').val();
let item_details = $('#details').val();
let file = $('#image')[0].files[0];
if(item_category == null || item_name == ""){
    modalInit("<h6 class='alert alert-danger'>Item Category and Item Name fields are required.</h6><hr />", 'Error!');
    return;
};
var data = {item_category_id:item_category,name:item_name,details:item_details,image_url:file}
addDataWithAjax('/admin/item',data,"#errors","#success_msg","/admin/item/reload","reload_div")
});
