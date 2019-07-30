$(document).on('click','#init_modal',function(){
  modalLayoutReset();
  modalInit(formDataString, 'Add new Item');
});

$(document).on('click','#btn_add',function(){
let item_category = $('#item_category').val();
let item_name = $('#name').val();
let item_details = $('#details').val();
let file = $('#image')[0].files[0];
// if(item_category == null || item_name == "") {
//     modalInit(
//         `<h6 class='text-danger'>
//             Item category and item name fields are required.
//         </h6><hr />`,
//        'Error!'
//    );
//     return;
// };
 var data = new FormData();
 data.append('item_category_id',item_category);
 data.append('name',item_name);
 data.append('details',item_details);
 data.append('image_url',file);
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

function modalLayoutReset(){
  let modal_dilog = document.querySelector("#masterModal .modal-dialog");
  modal_dilog.classList.remove('modal-xl');
}
