<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Country;
use App\Admin\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function reload()
    {
        $cities = City::orderBy('name', 'ASC')->paginate(8);
        $returnHTML = view('admin.city.reload')->with('cities', $cities)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
}

    public function index()
    {
        $countries = Country::all();
        $cities = City::orderBy('name', 'ASC')->paginate(8);
        return view('admin.city.index',compact('countries','cities'));
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
    public function store(Request $request)     {
        $validator = \Validator::make($request->all(), [
            'country_id' => 'required',
            'name' => 'required|unique:cities|max:255|min:3',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            City::create(['user_id' => 1,'country_id' => $request->country_id,'name' => $request->name]);
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
      $countries = Country::all();
      $city = City::find($id);
        $returnHTML = view('admin.city.edit')->with(['countries'=>$countries,'city'=>$city])->render();
        return response()->json(['success' => true, 'edit_html'=>$returnHTML]);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'country_id' => 'required',
            'name' => 'required|max:255|unique:cities,name,'.request('id'),
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $country = City::find(request('id'))->update(['country_id' => $request->country_id,'name' => $request->name]);
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
        $deleted = City::find(request('id'))->delete();
            if ($deleted) {
            return response()->json(['success'=>'Record is successfully deleted']);
        }
    }
}
