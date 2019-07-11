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
    public function index()
    {
        $countries = Country::all();
        $cities = City::orderBy('name', 'ASC')->paginate(5);
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
    public function store(Request $request) {
       $this->validate($request, [
           'country' => 'required',
           'name' => 'required|max:60|unique:cities'
       ]);
    

      $city =  City::create([
           'user_id' => '1',
           'country_id' => $request->country,
           'name' => $request->name,
       ]);
    
       
      if ($city) {
          return redirect()->route('admin.city.index')->with('status','City '.$request->name.' added');
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
       $city = City::find($id);
       $countries = Country::all();
       return view('admin.city.edit',compact('city','countries'));
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
        $this->validate($request,[
            'country'=>'required',
            'name'=>'required|max:60|unique:cities',
        ]);

   $city = City::find($id)->update(['country_id' => $request->country,'name' => $request->name]);
   if($city){
    return redirect()->route('admin.city.index')->with('status','city updated successfully');
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
        $city = City::find($id)->delete();
        if($city){
            return redirect()->route('admin.city.index')->with('status','City Deleted');
        }
    }
}
