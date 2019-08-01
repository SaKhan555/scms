$(document).on('click','#init_modal',function(){
  modalLayoutReset();
  modalInit(formDataString, 'Add new Item');
});

$(document).on('click','#btn_add',function(){
let item_category = $('#item_category');
let item_name = $('#name');
let item_details = $('#details');
let file = $('#image');

if(requireElements([item_category,item_name, ])) 
{
   return;
}

var data = new FormData();
  data.append('item_category_id',item_category.val());
  data.append('name',item_name.val());
  data.append('details',item_details.val());
  data.append('image_url',file[0].files[0]);
var sendData = data;
  addDataWithAjax('/admin/item',sendData,"#errors","#success_msg","/admin/item/reload","reload_div");
});

  $(document).on("click", ".btn_edit", function(event){
  let modal_dilog = document.querySelector("#masterModal .modal-dialog");
  let item_id = $(this).attr('data-id');
  let send_item_id = {id:item_id};
  modal_dilog.classList.add('modal-xl');
  editFormWithAjax(`/admin/item/edit`,send_item_id,"Edit Item");
});

$(document).on('click','#btn_update', function(){
  let id = $(this).attr('data-id');
  let item_category = $('#e_item_category');
  let item_name = $('#e_name');
  let item_details = $('#e_details');
  let file = $('#e_image');
  
  if(requireElements([item_category,item_name, ])) 
  {
     return;
  }
  
  var data = new FormData();
    data.append('id',id);
    data.append('_method','PUT');
    data.append('item_category_id',item_category.val());
    data.append('name',item_name.val());
    data.append('details',item_details.val());
    data.append('image_url',file[0].files[0]);
    let sendData = data;
    updateDataWithAjax('/admin/item/update',sendData,"#errors","#success_msg","/admin/item/reload","reload_div");
});

function modalLayoutReset(){
  let modal_dilog = document.querySelector("#masterModal .modal-dialog");
  modal_dilog.classList.remove('modal-xl');
}
