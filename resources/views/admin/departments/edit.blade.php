@extends('layouts.admin')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 600;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e3c72;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .subsection {
            margin-bottom: 25px;
        }
        .subsection-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .card-content {
            padding: 25px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-group label .required {
            color: #dc3545;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            max-width: 470px;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
            background: #fff;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
            max-width: 100%;
        }
        .form-group input:disabled,
        .form-group select:disabled {
            background: #e9ecef;
            cursor: not-allowed;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            cursor: pointer;
        }
        .radio-group input[type="radio"] {
            width: auto;
            max-width: none;
            cursor: pointer;
        }
        .radio-group input[type="radio"] {
                appearance: auto !important;
                -webkit-appearance: radio !important;
                accent-color: #1e3c72; /* optional color */
            }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 8px;
        }
        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            cursor: pointer;
        }
        .checkbox-group input[type="checkbox"] {
            width: auto;
            max-width: none;
            cursor: pointer;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-start;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 150px;
            justify-content: center;
        }
        .btn-primary {
            background: #1e3c72;
            color: #fff;
        }
        .btn-primary:hover {
            background: #152b54;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 60, 114, 0.3);
        }
        .btn-secondary {
            background: #dc3545;
            color: #fff;
        }
        .btn-secondary:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }
    </style>
    <div class="container">
        <div class="header">
            <i class="fas fa-sitemap fa-2x"></i>
            <h1>Edit Department</h1>
        </div>
        <form action="{{ route('admin.departments.update', $department->id) }}" method="POST" id="editDepartmentForm" novalidate>
            @csrf
            @method('PUT')
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Department Basic Information
                </div>
                <div class="subsection">
                    <div class="subsection-card">
                        <div class="card-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-building"></i>
                                        Department Name <span class="required">*</span>
                                    </label>
                                    <input type="text" name="name" placeholder="Enter department name" value="{{ old('name', $department->name) }}" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-barcode"></i>
                                        Department Code <span class="required">*</span>
                                    </label>
                                    <input type="text" name="code" placeholder="Enter unique department code" value="{{ old('code', $department->code) }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-layer-group"></i>
                                        Department Category <span class="required">*</span>
                                    </label>
                                    <select name="category" required>
                                        <option value="">Select category</option>
                                        <option value="operations" {{ old('category', $department->category) == 'operations' ? 'selected' : '' }}>Operations</option>
                                        <option value="support" {{ old('category', $department->category) == 'support' ? 'selected' : '' }}>Support</option>
                                        <option value="administration" {{ old('category', $department->category) == 'administration' ? 'selected' : '' }}>Administration</option>
                                        <option value="technical" {{ old('category', $department->category) == 'technical' ? 'selected' : '' }}>Technical</option>
                                        <option value="finance" {{ old('category', $department->category) == 'finance' ? 'selected' : '' }}>Finance</option>
                                        <option value="hr" {{ old('category', $department->category) == 'hr' ? 'selected' : '' }}>Human Resources</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-sitemap"></i>
                                        Parent Department
                                    </label>
                                    <select name="parent_department">
                                        <option value="">Select parent department (optional)</option>
                                        <option value="dept1" {{ old('parent_department', $department->parent_department) == 'dept1' ? 'selected' : '' }}>Operations Division</option>
                                        <option value="dept2" {{ old('parent_department', $department->parent_department) == 'dept2' ? 'selected' : '' }}>Finance & Accounts</option>
                                        <option value="dept3" {{ old('parent_department', $department->parent_department) == 'dept3' ? 'selected' : '' }}>Corporate Office</option>
                                        <option value="dept4" {{ old('parent_department', $department->parent_department) == 'dept4' ? 'selected' : '' }}>Technical Services</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-toggle-on"></i>
                                        Department Status <span class="required">*</span>
                                    </label>
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" name="status" value="active" {{ trim(old('status', $department->status)) === 'active' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="inactive" {{ trim(old('status', $department->status)) === 'inactive' ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-calendar-check"></i>
                                        Established Date
                                    </label>
                                    <input type="date" name="established_date" value="{{ old('established_date', $department->established_date) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 2: Leadership & Management -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-users-cog"></i>
                    Leadership & Management
                </div>
                <div class="subsection">
                    <div class="subsection-card">
                        <div class="card-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-tie"></i>
                                        Department Head <span class="required">*</span>
                                    </label>
                                    <input type="text" name="department_head" placeholder="Enter department head name" value="{{ old('department_head', $department->department_head) }}" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-id-badge"></i>
                                        Employee ID
                                    </label>
                                    <input type="text" name="employee_id" placeholder="Enter employee ID" value="{{ old('employee_id', $department->employee_id) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-envelope"></i>
                                        Official Email <span class="required">*</span>
                                    </label>
                                    <input type="email" name="email" placeholder="department@company.com" value="{{ old('email', $department->email) }}" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-phone"></i>
                                        Contact Number <span class="required">*</span>
                                    </label>
                                    <input type="tel" name="contact_number" placeholder="+91 XXXXX XXXXX" pattern="[0-9+\s-]{10,15}" value="{{ old('contact_number', $department->contact_number) }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-phone-alt"></i>
                                        Extension Number
                                    </label>
                                    <input type="text" name="extension_number" placeholder="Enter extension" value="{{ old('extension_number', $department->extension_number) }}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-friends"></i>
                                        Reporting To
                                    </label>
                                    <select name="reporting_to">
                                        <option value="">Select reporting department</option>
                                        <option value="ceo" {{ old('reporting_to', $department->reporting_to) == 'ceo' ? 'selected' : '' }}>CEO Office</option>
                                        <option value="coo" {{ old('reporting_to', $department->reporting_to) == 'coo' ? 'selected' : '' }}>COO Office</option>
                                        <option value="cfo" {{ old('reporting_to', $department->reporting_to) == 'cfo' ? 'selected' : '' }}>CFO Office</option>
                                        <option value="vp" {{ old('reporting_to', $department->reporting_to) == 'vp' ? 'selected' : '' }}>Vice President</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section: Location & Operational Details -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-map-marker-alt"></i>
                    Location & Operational Details
                </div>
                <div class="subsection">
                    <div class="subsection-card">
                        <div class="card-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-building"></i>
                                        Primary Location <span class="required">*</span>
                                    </label>
                                    <select name="location" required>
                                        <option value="">Select location</option>
                                        <option value="loc1" {{ old('location', $department->location) == 'loc1' ? 'selected' : '' }}>Head Office - Mumbai</option>
                                        <option value="loc2" {{ old('location', $department->location) == 'loc2' ? 'selected' : '' }}>Regional Office - Delhi</option>
                                        <option value="loc3" {{ old('location', $department->location) == 'loc3' ? 'selected' : '' }}>Branch Office - Bangalore</option>
                                        <option value="loc4" {{ old('location', $department->location) == 'loc4' ? 'selected' : '' }}>Warehouse - Pune</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-door-open"></i>
                                        Office / Floor Number
                                    </label>
                                    <input type="text" name="office_floor" placeholder="e.g., 3rd Floor, Wing A" value="{{ old('office_floor', $department->office_floor) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-users"></i>
                                        Total Employees
                                    </label>
                                    <input type="number" name="total_employees" placeholder="Enter number of employees" min="0" value="{{ old('total_employees', $department->total_employees) }}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-clock"></i>
                                        Working Hours
                                    </label>
                                    <input type="text" name="working_hours" placeholder="e.g., 9:00 AM - 6:00 PM" value="{{ old('working_hours', $department->working_hours) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-calendar-week"></i>
                                        Working Days
                                    </label>
                                    <input type="text" name="working_days" placeholder="e.g., Monday to Friday" value="{{ old('working_days', $department->working_days) }}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-briefcase"></i>
                                        Department Type
                                    </label>
                                    <select name="department_type">
                                        <option value="">Select type</option>
                                        <option value="revenue" {{ old('department_type', $department->department_type) == 'revenue' ? 'selected' : '' }}>Revenue Generating</option>
                                        <option value="support" {{ old('department_type', $department->department_type) == 'support' ? 'selected' : '' }}>Support Function</option>
                                        <option value="overhead" {{ old('department_type', $department->department_type) == 'overhead' ? 'selected' : '' }}>Overhead</option>
                                        <option value="mixed" {{ old('department_type', $department->department_type) == 'mixed' ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section: Functional Attributes -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-tasks"></i>
                    Functional Attributes
                </div>
                <div class="subsection">
                    <div class="subsection-card">
                        <div class="card-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-check-square"></i>
                                        Core Functions
                                    </label>
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" name="functions" value="asset_management" {{ old('functions', is_array($department->functions) ? $department->functions[0] ?? '' : $department->functions) == 'asset_management' ? 'checked' : '' }}>
                                            Asset Management
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="procurement" {{ old('functions', is_array($department->functions) ? $department->functions[0] ?? '' : $department->functions) == 'procurement' ? 'checked' : '' }}>
                                            Procurement
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="maintenance" {{ old('functions', is_array($department->functions) ? $department->functions[0] ?? '' : $department->functions) == 'maintenance' ? 'checked' : '' }}>
                                            Maintenance
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="compliance" {{ old('functions', is_array($department->functions) ? $department->functions[0] ?? '' : $department->functions) == 'compliance' ? 'checked' : '' }}>
                                            Compliance & Audit
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-shield-alt"></i>
                                        Compliance Requirements
                                    </label>
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" name="compliance" value="yes" {{ trim(old('compliance', $department->compliance)) === 'yes' ? 'checked' : '' }}>
                                            Yes
                                        </label>
                                        <label>
                                            <input type="radio" name="compliance" value="no" {{ trim(old('compliance', $department->compliance)) === 'no' ? 'checked' : '' }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-certificate"></i>
                                        Certifications Required
                                    </label>
                                    <input type="text" name="certifications" placeholder="List required certifications" value="{{ old('certifications', $department->certifications) }}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-shield"></i>
                                        Security Level
                                    </label>
                                    <select name="security_level">
                                        <option value="">Select security level</option>
                                        <option value="public" {{ old('security_level', $department->security_level) == 'public' ? 'selected' : '' }}>Public</option>
                                        <option value="internal" {{ old('security_level', $department->security_level) == 'internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="confidential" {{ old('security_level', $department->security_level) == 'confidential' ? 'selected' : '' }}>Confidential</option>
                                        <option value="restricted" {{ old('security_level', $department->security_level) == 'restricted' ? 'selected' : '' }}>Restricted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section: Additional Information -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-clipboard"></i>
                    Additional Information
                </div>
                <div class="subsection">
                    <div class="subsection-card">
                        <div class="card-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-align-left"></i>
                                        Department Description
                                    </label>
                                    <textarea name="description" placeholder="Brief description of department's role and responsibilities">{{ old('description', $department->description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-bullseye"></i>
                                        Key Performance Indicators (KPIs)
                                    </label>
                                    <textarea name="kpis" placeholder="List key performance indicators">{{ old('kpis', $department->kpis) }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-comment-dots"></i>
                                        Remarks / Notes
                                    </label>
                                    <textarea name="remarks" placeholder="Additional remarks or special notes">{{ old('remarks', $department->remarks) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Department
                </button>
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>

<script>
document.getElementById("editDepartmentForm").addEventListener("submit", function(e) {
    let valid = true;
    let messages = [];

    let name = document.querySelector("[name='name']").value.trim();
    let code = document.querySelector("[name='code']").value.trim();
    let email = document.querySelector("[name='email']").value.trim();
    let contact = document.querySelector("[name='contact_number']").value.trim();
    let category = document.querySelector("[name='category']").value;
    let location = document.querySelector("[name='location']").value;
    let status = document.querySelector("input[name='status']:checked");

    if (name.length < 2) messages.push("Department name must be at least 2 characters.");
    if (code === "") messages.push("Department code is required.");
    if (category === "") messages.push("Category is required.");
    if (!status) messages.push("Status is required.");
    if (location === "") messages.push("Location is required.");

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) messages.push("Enter a valid email address.");

    let phonePattern = /^[0-9+\s-]{10,15}$/;
    if (!phonePattern.test(contact)) messages.push("Enter a valid contact number.");

    if (messages.length > 0) {
        e.preventDefault();
        alert(messages.join("\n"));
    }
});
</script>
@endsection