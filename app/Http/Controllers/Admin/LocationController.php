<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.locations.create', compact('locations'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'location_name' => 'required',
                'location_code' => 'required|unique:locations',
                'location_type' => 'required',
                'status' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'pincode' => 'required',
                'manager_name' => 'required',
                'primary_contact' => 'required',
                'email' => 'required|email',
                'alternate_contact' => 'nullable',
                'fax_number' => 'nullable', 
                'remarks' => 'nullable',
            ]);

        Location::create($request->all());
            return redirect()->route('admin.locations.index')
                ->with('success', 'Location created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the location.');
        }
    }
}
