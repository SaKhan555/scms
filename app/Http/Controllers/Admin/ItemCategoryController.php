<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ItemCategory;

class ItemCategoryController extends Controller
{

    public function index()
    {
        $item_categories = ItemCategory::orderBy('name','ASC')->paginate(10);

        return view('admin.item_category.index',compact('item_categories'));
    }

    public function create()
    {
//
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:60|unique:item_categories'
        ]);

        ItemCategory::create([
            'user_id' => '1',
            'name' => $request->name,
        ]);

        return redirect()->route('admin.item_category.index')->with('status','Item '.$request->name.' Added.');

    }
    public function show($id)
    {
//
    }

    public function edit($id)
    {
        $item_category = ItemCategory::find($id);

        return view('admin.item_category.edit',compact('item_category'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:60|unique:item_categories,name,'.$id,
        ]);

        ItemCategory::find($id)->update([
            'user_id' => '1',
            'name' => $request->name,
        ]);

        return redirect()->route('admin.item_category.index')->with('status','Category '.$request->name.' updated');
    }

    public function destroy($id)
    {
        $item_category = ItemCategory::find($id)->delete();

        return redirect()->route('admin.item_category.index')->with('status','deleted successfully.');
    }
}
