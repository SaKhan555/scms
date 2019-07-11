<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

use App\Admin\Warehouse;
use App\Admin\Country;
use App\Admin\City;
use Illuminate\Contracts\View\View;

class WarehouseController extends Controller
{
    public function index()
    {
    $warehouses = Warehouse::orderBy('name', 'ASC')->paginate(7);
    $countries = Country::orderBy('name', 'ASC')->get(['id', 'name']);
    return view('admin.warehouse.index', compact('warehouses', 'countries'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:warehouses',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required|max:191',
        ]);

        Warehouse::create([
            'user_id' => '1',
            'warehouse_code_number' => $this->warehouse_code_number($request->name),
            'name' => $request->name,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'address' => $request->address,
            'details' => $request->details,
        ]);

        return redirect()->route('admin.warehouse.index')->with('status', ' Warehouse ' . $request->name . ' Added');
    }

    public function show(Warehouse $warehouse)
    {
        return view('admin.warehouse.show', compact('warehouse'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }

    public function getCities(Request $request)
    {
        $city = City::where('country_id', $request->country_id)->get(['id', 'name']);
        return $city;
    }

    public function warehouse_code_number($request_name)
    {
        $count_warehouse = Warehouse::count();
        ++$count_warehouse; // add 1;
        $len = strlen($count_warehouse);

        for ($i = $len; $i < 3; ++$i) {
            $count_warehouse = '0' . $count_warehouse;
        }

        $warehouse_name = strtoupper(substr($request_name, 0, 2));
        $warehouse_code_number = 'WHS-' . $warehouse_name . '-' . $count_warehouse;
        return $warehouse_code_number;
    }
}
