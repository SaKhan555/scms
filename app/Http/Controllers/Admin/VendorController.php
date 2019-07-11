<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\File;
use App\Admin\Vendor;
use App\Admin\Country;
use App\Admin\City;

class VendorController extends Controller
{
    private $PDF;

    public function __construct(PDF $PDF){
        $this->PDF = $PDF;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('name','ASC')->paginate(5);
        return view('admin.vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('admin.vendor.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $this->validate($request,[
            'name' => 'required|max:30',
            'email' => 'required|max:30|unique:vendors',
            'contact_number' => 'required|max:15',
            'address' => 'required|max:191',
            'address' => 'required|max:191',
            'country' => 'required',
            'city' => 'required',
            ]);


        if($request->hasfile('image')) { 
          $photo = $request->file('image');
          $photoname = $photo->getClientOriginalName();
          $photoname = $this->vendor_code_number($request->name).'-'.$photoname;
          $photo->move('uploads/vendor/', $photoname);
        }else{
            $photoname = null;
        }

        $vendor = Vendor::create([
            'user_id' => '1',
            'vendor_code_number' => $this->vendor_code_number($request->name),
            'name' => $request->name,
            'email' => $request->email,
            'contact_number_primary' => $request->contact_number,
            'contact_number_optional' => $request->contact_number_optional,
            'address' => $request->address,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'image_url' => $photoname,
        ]);

        if($vendor){
            return redirect()->route('admin.vendor.index')->with('status','vendor '.$this->vendor_code_number($request->name).' add successfully');
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
        $vendor = Vendor::find($id);
        return view('admin.vendor.show',compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $countries = Country::orderBy('name', 'ASC')->get();
        $cities = Country::find($vendor->country_id);
        return view('admin.vendor.edit',compact('vendor','countries','cities'));
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
            'name' => 'required|max:30',
            'email' => 'required|max:30|unique:vendors,email,'.$id,
            'contact_number' => 'required|max:15',
            'address' => 'required|max:191',
            'address' => 'required|max:191',
            'country' => 'required',
            'city' => 'required',
        ]);
$vendor = Vendor::find($id);

        if($request->hasfile('image')) { 
             
             if($vendor->image_url != '' && file_exists(public_path().'/uploads/vendor/'.$vendor->image_url )) {
                unlink(public_path().'/uploads/vendor/'.$vendor->image_url);
            }

          $photo = $request->file('image');
          $photoname = $photo->getClientOriginalName();
          $photoname = $this->vendor_code_number($request->name).'-'.$photoname;
          $photo->move('uploads/vendor/', $photoname);
        } else {
            $photoname = $vendor->image_url;
        }

        $vendor = $vendor->update([
            'user_id' => '1',
            'name' => $request->name,
            'email' => $request->email,
            'contact_number_primary' => $request->contact_number,
            'contact_number_optional' => $request->contact_number_optional,
            'address' => $request->address,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'image_url' => $photoname,
        ]);

         if($vendor){
            return redirect()->route('admin.vendor.index')->with('status','vendor '.$this->vendor_code_number($request->name).' updated');
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
        $vendor = Vendor::find($id);
             if($vendor->image_url != '' && file_exists(public_path().'/uploads/vendor/'.$vendor->image_url )) {
                unlink(public_path().'/uploads/vendor/'.$vendor->image_url);
            }
        $vendor->delete();
        return redirect()->back()->with('status','Vendor Deleted.' );
    }

    public function getCities(Request $request) {
        $city = City::where('country_id', $request->country_id)->get(['id','name']);
        return $city;
    }

    public function vendor_code_number ($request_name){  
     $count_vendor = Vendor::count();
    ++$count_vendor; // add 1;
    $len = strlen($count_vendor);

    for($i = $len; $i < 3; ++$i) {
        $count_vendor = '0'.$count_vendor;
    }
        $vendor_name = strtoupper(substr($request_name,0,2));
        $vendor_code_number =  'VDR-'.$vendor_name.'-'.$count_vendor;
        return $vendor_code_number;
 }

  public function generatePDF($id)
  {
    $vendor = Vendor::find($id);
    $pdf = PDF::loadView('admin.vendor.pdf', ['vendor' => $vendor]);
    return $pdf->stream();
  }
}


  

  
