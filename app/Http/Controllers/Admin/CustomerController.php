<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Admin\Customer;
use App\Admin\Country;
use App\Admin\City;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::orderBy('name','ASC')->paginate(5);
        return view('admin.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $countries = Country::orderBy('name','ASC')->get(['id','name']);
        return view('admin.customer.create',compact('countries'));
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
            'email' => 'required|max:30|unique:customers',
            'contact_number_primary' => 'required|max:15|unique:customers',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required|max:200',
        ]);

        if($request->hasfile('image')) {
            $photo = $request->file('image');
            $photoname = $photo->getClientOriginalName();
            $photoname = $this->customer_code_number($request->name).'-'.$photoname;
            $photo->move('uploads/customer/', $photoname);
        }else{
            $photoname = null;
        }

        $customer = Customer::create([
            'user_id' => '1',
            'customer_code_number' => $this->customer_code_number($request->name),
            'name' => $request->name,
            'email' => $request->email,
            'contact_number_primary' => $request->contact_number_primary,
            'contact_number_optional' => $request->contact_number_optional,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'address' => $request->address,
            'image_url' => $photoname,
        ]);
        if ($customer) {
            return redirect()->route('admin.customer.index')->with('status','Customer Added');
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
        $customer = Customer::find($id);
        return view('admin.customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $countries = Country::orderBy('name', 'ASC')->get();
        $cities = Country::find($customer->country_id);
        return view('admin.customer.edit',compact('customer','countries','cities'));
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
            'email' => 'required|max:30|unique:customers,email,'.$id,
            'contact_number' => 'required|max:15|unique:customers,contact_number_primary,'.$id,
            'address' => 'required|max:191',
            'country' => 'required',
            'city' => 'required',
        ]);
$customer = Customer::find($id);

        if($request->hasfile('image')) { 
             
             if($customer->image_url != '' && file_exists(public_path().'/uploads/customer/'.$customer->image_url )) {
                unlink(public_path().'/uploads/customer/'.$customer->image_url);
            }

          $photo = $request->file('image');
          $photoname = $photo->getClientOriginalName();
          $photoname = $this->customer_code_number($request->name).'-'.$photoname;
          $photo->move('uploads/customer/', $photoname);
        } else {
            $photoname = $customer->image_url;
        }

        $customer = $customer->update([
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

         if($customer){
            return redirect()->route('admin.customer.index')->with('status','Customer '.$this->customer_code_number($request->name).' updated');
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
        $customer = Customer::find($id);
             if($customer->image_url != '' && file_exists(public_path().'/uploads/customer/'.$customer->image_url )) {
                unlink(public_path().'/uploads/customer/'.$customer->image_url);
            }
        $customer->delete();
        return redirect()->back()->with('status','Customer Deleted.' );
    }

    public function customer_code_number ($request_name){
        $count_customer = Customer::count();
        ++$count_customer; // add 1;
        $len = strlen($count_customer);

        for($i = $len; $i < 3; ++$i) {
            $count_customer = '0'.$count_customer;
        }
        $customer_name = strtoupper(substr($request_name,0,2));
        $customer_code_number =  'CR-'.$customer_name.'-'.$count_customer;
        return $customer_code_number;
    }

    public function getCities(Request $request) {
        $city = City::where('country_id', $request->country_id)->get(['id','name']);
        return $city;
    }

 public function search()
    {
        $s = trim(request('search'));
        if($s) {
            $customers = Customer::where('customer_code_number', 'LIKE', '%' . $s . '%')
                ->orWhere('name', 'LIKE', '%' . $s . '%')
                ->orWhere('contact_number_primary', 'LIKE', '%' . $s . '%');
                      return view('admin.customer.index',
                        ['customers' => $customers->paginate(15)]);
        }else{
             $customers = Customer::paginate(15);
             return view('admin.customer.index',
                        ['customers' => $customers]);
        }
  
    }
}
