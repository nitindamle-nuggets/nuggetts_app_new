<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $departmentId = $this->route('department')->id;

        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:departments,code,' . $departmentId,
            'category' => 'required',
            'status' => 'required',
            'established_date' => 'nullable|date',
            'parent_department' => 'nullable|string|max:255',
            'department_type' => 'nullable|string|max:255',
            'functions' => 'nullable|array',
            'employee_id' => 'nullable|string|max:255',
            'reporting_to' => 'nullable|string|max:255',
            'extension_number' => 'nullable|string|max:20',
            'department_head' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|digits_between:10,15',
            'location' => 'required',
            'functions' => 'nullable|array',
            'compliance' => 'required',
            'total_employees' => 'nullable|integer|min:0',
            'working_hours' => 'nullable|string|max:255',
            'working_days' => 'nullable|string|max:255',
            'office_floor' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'kpis' => 'nullable|string',
            'remarks' => 'nullable|string',
            'certifications' => 'nullable|string|max:255',
            'security_level' => 'nullable|string|max:255',
        
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Department name is required',
            'code.required' => 'Department code is required',
            'code.unique' => 'Department code already exists',
            'department_head.required' => 'Department head is required',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'contact_number.required' => 'Contact number is required',
            'location.required' => 'Location is required',
        ];
    }
}
