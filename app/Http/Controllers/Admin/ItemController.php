<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Validation\Rule;
use App\Admin\ItemCategory;
use App\Admin\Item;

class ItemController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
    $items = Item::orderBy('name','ASC')->paginate(7);
    $item_categories = ItemCategory::orderBy('name','ASC')->get(['id','name']);

    return view('admin.item.index',compact('items','item_categories'));
}

/**
* Show the form for creating a new resource.
*T
* @return \Illuminate\Http\Response
*/
public function create()
{

}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
    $category_id = $request->item_category;

    $this->validate($request,[
        'item_category' => 'required',
        'details' => 'max:191',
        'name' => Rule::unique('items')->where(function ($query) use ($category_id) {
            return $query->where('item_category_id',$category_id);
        }),

    ]);

    if($request->hasfile('image')) {
        $photo = $request->file('image');
        $photoname = $photo->getClientOriginalName();
        $photoname = $this->item_code_number($request->name).'-'.$photoname;
        $photo->move('uploads/item/', $photoname);
    }else{
        $photoname = null;
    }

    Item::create([
        'user_id' => '1',
        'item_code_number' => $this->item_code_number($request->name),
        'item_category_id' => $request->item_category,
        'name' => $request->name,
        'image_url' => $photoname,
        'details' => $request->details,
    ]);

    return redirect()->route('admin.item.index')->with('status','Item '.$this->item_code_number ($request->name).' added.');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $item = Item::find($id);
    return view('admin.item.show',compact('item'));
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{

    $item = Item::find($id);
    $item_categories = ItemCategory::orderBy('name')->get(['id','name']);
    return view('admin.item.edit',compact('item','item_categories'));
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    $category_id = $request->item_category;
    $this->validate($request,[
        'item_category' => 'required',
        'name' => Rule::unique('items')->ignore($id)->where(function ($query) use ($category_id) {
            return $query->where('item_category_id', $category_id);
        }),

    ]);

    $item = Item::find($id);

    if($request->hasfile('image')) { 
        if($item->image_url != '' && file_exists(public_path().'/uploads/item/'.$item->image_url )) {
            unlink(public_path().'/uploads/item/'.$item->image_url);
        }

        $photo = $request->file('image');
        $photoname = $photo->getClientOriginalName();
        $photoname = $this->item_code_number($request->name).'-'.$photoname;
        $photo->move('uploads/item/', $photoname);
    } else {
        $photoname = $item->image_url;
    }

    $item->update([
        'user_id' => '1',
        'item_category_id' => $request->item_category,
        'name' => $request->name,
        'image_url' => $photoname,
        'details' => $request->details,
    ]);

    return redirect()->route('admin.item.index')->with('status','updated.');

}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}

public function item_code_number ($request_name){
    $count_item = Item::count();
++$count_item; // add 1;
$len = strlen($count_item);

for($i = $len; $i < 3; ++$i) {
    $count_item = '0'.$count_item;
}
$item_name = strtoupper(substr($request_name,0,2));
$item_code_number =  'ITEM-'.$item_name.'-'.$count_item;
return $item_code_number;
}
}
