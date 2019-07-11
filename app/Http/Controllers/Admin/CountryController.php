<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('name', 'ASC')->paginate(8);
       return view('admin.country.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

public function reload()
    {
        $countries = Country::orderBy('name', 'ASC')->paginate(8);
        $returnHTML = view('admin.country.reload')->with('countries', $countries)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
}



  public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:countries|max:255',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            Country::create(['user_id' => 1,'name' => $request->name]);
            return response()->json(['success'=>'Record is successfully added']);
        } 
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $country = Country::find($id);
        $returnHTML = view('admin.country.edit')->with('country', $country)->render();
        return response()->json(array('success' => true, 'edit_html'=>$returnHTML));
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255|unique:countries,name,'.request('id'),
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $country = Country::find(request('id'))->update(['name' => $request->name]);
            return response()->json(['success'=>'Record is successfully updated']);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Country::find(request('id'))->delete();
            if ($deleted) {
            return response()->json(['success'=>'Record is successfully deleted']);
        }
    }
}
