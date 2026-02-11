<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id','desc')->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:100|unique:departments,code',
                    'category' => 'required',
                    'status' => 'required',
                    'department_head' => 'required|string|max:255',
                    'email' => 'required|email',
                    'contact_number' => 'required',
                    'location' => 'required',
                ]);
                Department::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'category' => $request->category,
                    'parent_department' => $request->parent_department,
                    'status' => $request->status,
                    'established_date' => $request->established_date,

                    'department_head' => $request->department_head,
                    'employee_id' => $request->employee_id,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'extension_number' => $request->extension_number,
                    'reporting_to' => $request->reporting_to,

                    'location' => $request->location,
                    'office_floor' => $request->office_floor,
                    'total_employees' => $request->total_employees,
                    'working_hours' => $request->working_hours,
                    'working_days' => $request->working_days,
                    'department_type' => $request->department_type,

                    'functions' => implode(',', (array)$request->functions),
                    'compliance' => $request->compliance,
                    'certifications' => $request->certifications,
                    'security_level' => $request->security_level,

                    'description' => $request->description,
                    'kpis' => $request->kpis,
                    'remarks' => $request->remarks,
                ]);
            return redirect()->route('admin.departments.index')
                ->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the department.');
        }
    }

    public function edit(Department $department)
    {
        $departments = Department::all();
        return view('admin.departments.edit', compact('department', 'departments'));
    }

    public function update(Request $request, $id)
    {
        try {
                $request->validate([
                        'name' => 'required|string|max:255',
                        'code' => 'required|string|max:100',
                        'category' => 'required',
                        'status' => 'required',
                        'email' => 'required|email',
                        'contact_number' => 'required',
                        'location' => 'required',
                    ]);

                    $department = Department::findOrFail($id); // ✅ find correct row

                    $department->update($request->all()); // ✅ update only this record

            return redirect()->route('admin.departments.index')
                ->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating the department.');
        }
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('admin.departments.index')
                ->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the department.');
        }
    }
}
