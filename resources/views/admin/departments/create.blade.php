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

        .tabs {
            display: flex;
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .tabs::-webkit-scrollbar {
            height: 6px;
        }

        .tabs::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .tabs::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .tab-button {
            padding: 15px 25px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #495057;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 3px solid transparent;
        }

        .tab-button:hover {
            background: #e9ecef;
            color: #1e3c72;
        }

        .tab-button.active {
            color: #1e3c72;
            background: #fff;
            border-bottom-color: #1e3c72;
            font-weight: 600;
        }

        .tab-content {
            display: none;
            padding: 30px;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead {
            background: #1e3c72;
            color: #fff;
        }

        table thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
        }

        table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
            transition: all 0.3s ease;
        }

        .action-btn-edit {
            background: #007bff;
            color: #fff;
        }

        .action-btn-edit:hover {
            background: #0056b3;
        }

        .action-btn-delete {
            background: #dc3545;
            color: #fff;
        }

        .action-btn-delete:hover {
            background: #c82333;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2a5298;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .info-box p {
            margin: 0;
            color: #1e3c72;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .tab-content {
                padding: 20px 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                max-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            table {
                font-size: 12px;
            }

            table thead th,
            table tbody td {
                padding: 10px;
            }

            .section-title {
                font-size: 18px;
            }

            .card-content {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 18px;
            }

            .tab-button {
                padding: 12px 15px;
                font-size: 12px;
            }

            table thead th,
            table tbody td {
                padding: 8px;
                font-size: 11px;
            }

            .action-btn {
                padding: 4px 8px;
                font-size: 11px;
            }
        }
</style>
    <div class="container">
        <div class="header">
            <i class="fas fa-sitemap fa-2x"></i>
            <h1>Nuggetts EAM - Department Master</h1>
        </div>

        <div class="tabs">
            <!-- <button class="tab-button active" onclick="openTab(event, 'departmentInput')">
                <i class="fas fa-building"></i> Department Master
            </button> -->
            <button class="tab-button active" onclick="openTab(event, 'departmentRecords')">
                <i class="fas fa-list"></i> Department Master
            </button>
        </div>

        <!-- Department Master Tab -->
        <!-- <div id="departmentInput" class="tab-content active">
            <div class="info-box">
                <p><i class="fas fa-info-circle"></i> Create and manage organizational departments with hierarchical structure, cost centers, and operational mappings.</p>
            </div>

            <form action="{{ route('admin.departments.store') }}" method="POST" id="departmentForm" novalidate>
                @csrf
                 Display Errors -->
                <!-- @if ($errors->any())
                    <div style="background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; padding:15px; border-radius:6px; margin-bottom:20px;">
                        <strong>Errors found:</strong>
                        <ul style="margin:10px 0 0 0; padding-left:20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->

                <!-- Section 1: Department Basic Information -->
                <!-- <div class="section">
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
                                        <input type="text" name="name" placeholder="Enter department name" 
                                               value="{{ old('name') }}"
                                               minlength="2" maxlength="255" required
                                               style="{{ $errors->has('name') ? 'border-color:#dc3545;' : '' }}">
                                        @if ($errors->has('name'))
                                            <small style="color:#dc3545; margin-top:5px; display:block;">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Action Buttons -->
                <!-- <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">Save Department</button>
                    <button type="reset" class="btn btn-secondary" onclick="resetForm();">Reset Form</button>
                </div>
            </form>

            <script>
                // Client-side validation
                document.getElementById('departmentForm').addEventListener('submit', function(e) {
                    const nameInput = document.querySelector('input[name="name"]');
                    const nameValue = nameInput.value.trim();

                    // Validate name field
                    if (!nameValue) {
                        e.preventDefault();
                        alert('Department name is required.');
                        nameInput.focus();
                        return false;
                    }

                    if (nameValue.length < 2) {
                        e.preventDefault();
                        alert('Department name must be at least 2 characters.');
                        nameInput.focus();
                        return false;
                    }

                    if (nameValue.length > 255) {
                        e.preventDefault();
                        alert('Department name cannot exceed 255 characters.');
                        nameInput.focus();
                        return false;
                    }

                    return true;
                });

                function resetForm() {
                    document.getElementById('departmentForm').reset();
                }

                // Add real-time validation feedback
                document.querySelector('input[name="name"]').addEventListener('input', function() {
                    const value = this.value.trim();
                    if (value.length < 2 && value.length > 0) {
                        this.style.borderColor = '#dc3545';
                    } else if (value.length === 0) {
                        this.style.borderColor = '#ced4da';
                    } else {
                        this.style.borderColor = '#28a745';
                    }
                });
            </script> -->
        <!-- </div>  -->
         
          <!-- Display Errors  -->
            @if ($errors->any())
                <div style="background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; padding:15px; border-radius:6px; margin-bottom:20px;">
                    <strong>Errors found:</strong>
                    <ul style="margin:10px 0 0 0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <!-- Department Records Tab -->
    <div id="departmentRecords" class="tab-content active">
        <form action="{{ route('admin.departments.store') }}" method="POST" id="departmentForm" novalidate>
            @csrf
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
                                    <input type="text" name="name" placeholder="Enter department name" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-barcode"></i>
                                        Department Code <span class="required">*</span>
                                    </label>
                                    <input type="text" name="code" placeholder="Enter unique department code" required>
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
                                        <option value="operations">Operations</option>
                                        <option value="support">Support</option>
                                        <option value="administration">Administration</option>
                                        <option value="technical">Technical</option>
                                        <option value="finance">Finance</option>
                                        <option value="hr">Human Resources</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-sitemap"></i>
                                        Parent Department
                                    </label>
                                    <select name="parent_department">
                                        <option value="">Select parent department (optional)</option>
                                        <option value="dept1">Operations Division</option>
                                        <option value="dept2">Finance & Accounts</option>
                                        <option value="dept3">Corporate Office</option>
                                        <option value="dept4">Technical Services</option>
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
                                            <input type="radio" name="status" value="active" checked>
                                            Active
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-calendar-check"></i>
                                        Established Date
                                    </label>
                                    <input type="date" name="established_date">
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
                                    <input type="text" name="department_head" placeholder="Enter department head name" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-id-badge"></i>
                                        Employee ID
                                    </label>
                                    <input type="text" name="employee_id" placeholder="Enter employee ID">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-envelope"></i>
                                        Official Email <span class="required">*</span>
                                    </label>
                                    <input type="email" name="email" placeholder="department@company.com" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-phone"></i>
                                        Contact Number <span class="required">*</span>
                                    </label>
                                    <input type="tel" name="contact_number" placeholder="+91 XXXXX XXXXX" pattern="[0-9+\s-]{10,15}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-phone-alt"></i>
                                        Extension Number
                                    </label>
                                    <input type="text" name="extension_number" placeholder="Enter extension">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-friends"></i>
                                        Reporting To
                                    </label>
                                    <select name="reporting_to">
                                        <option value="">Select reporting department</option>
                                        <option value="ceo">CEO Office</option>
                                        <option value="coo">COO Office</option>
                                        <option value="cfo">CFO Office</option>
                                        <option value="vp">Vice President</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 3: Location & Operational Details -->
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
                                        <option value="loc1">Head Office - Mumbai</option>
                                        <option value="loc2">Regional Office - Delhi</option>
                                        <option value="loc3">Branch Office - Bangalore</option>
                                        <option value="loc4">Warehouse - Pune</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-door-open"></i>
                                        Office / Floor Number
                                    </label>
                                    <input type="text" name="office_floor" placeholder="e.g., 3rd Floor, Wing A">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-users"></i>
                                        Total Employees
                                    </label>
                                    <input type="number" name="total_employees" placeholder="Enter number of employees" min="0">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-clock"></i>
                                        Working Hours
                                    </label>
                                    <input type="text" name="working_hours" placeholder="e.g., 9:00 AM - 6:00 PM">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-calendar-week"></i>
                                        Working Days
                                    </label>
                                    <input type="text" name="working_days" placeholder="e.g., Monday to Friday">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-briefcase"></i>
                                        Department Type
                                    </label>
                                    <select name="department_type">
                                        <option value="">Select type</option>
                                        <option value="revenue">Revenue Generating</option>
                                        <option value="support">Support Function</option>
                                        <option value="overhead">Overhead</option>
                                        <option value="mixed">Mixed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 5: Functional Attributes -->
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
                                            <input type="radio" name="functions" value="asset_management">
                                            Asset Management
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="procurement">
                                            Procurement
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="maintenance">
                                            Maintenance
                                        </label>
                                        <label>
                                            <input type="radio" name="functions" value="compliance">
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
                                            <input type="radio" name="compliance" value="yes">
                                            Yes
                                        </label>
                                        <label>
                                            <input type="radio" name="compliance" value="no" checked>
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
                                    <input type="text" name="certifications" placeholder="List required certifications">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-shield"></i>
                                        Security Level
                                    </label>
                                    <select name="security_level">
                                        <option value="">Select security level</option>
                                        <option value="public">Public</option>
                                        <option value="internal">Internal</option>
                                        <option value="confidential">Confidential</option>
                                        <option value="restricted">Restricted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 6: Additional Information -->
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
                                    <textarea name="description" placeholder="Brief description of department's role and responsibilities"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-bullseye"></i>
                                        Key Performance Indicators (KPIs)
                                    </label>
                                    <textarea name="kpis" placeholder="List key performance indicators"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-comment-dots"></i>
                                        Remarks / Notes
                                    </label>
                                    <textarea name="remarks" placeholder="Additional remarks or special notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Save Department
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset Form
                </button>
            </div>
        </form>
    </div>

   
</div>
<script>
document.getElementById("departmentForm").addEventListener("submit", function(e) {

    let valid = true;
    let errors = [];

    const name = document.querySelector("[name='name']").value.trim();
    const code = document.querySelector("[name='code']").value.trim();
    const category = document.querySelector("[name='category']").value;
    const head = document.querySelector("[name='department_head']").value.trim();
    const email = document.querySelector("[name='email']").value.trim();
    const contact = document.querySelector("[name='contact_number']").value.trim();
    const location = document.querySelector("[name='location']").value;

    if(name === ""){
        valid = false;
        errors.push("Department name is required");
    }

    if(code === ""){
        valid = false;
        errors.push("Department code is required");
    }

    if(category === ""){
        valid = false;
        errors.push("Department category is required");
    }

    if(head === ""){
        valid = false;
        errors.push("Department head is required");
    }

    if(email === ""){
        valid = false;
        errors.push("Email is required");
    } else if(!/^\S+@\S+\.\S+$/.test(email)){
        valid = false;
        errors.push("Enter a valid email address");
    }

    if(contact === ""){
        valid = false;
        errors.push("Contact number is required");
    } else if(!/^[0-9+\s-]{10,15}$/.test(contact)){
        valid = false;
        errors.push("Enter valid contact number");
    }

    if(location === ""){
        valid = false;
        errors.push("Location is required");
    }

    if(!valid){
        e.preventDefault();

        let html = `<div style="background:#f8d7da;color:#721c24;padding:15px;border-radius:6px;">
                        <strong>Errors found:</strong>
                        <ul>`;
        errors.forEach(err => {
            html += `<li>${err}</li>`;
        });
        html += `</ul></div>`;

        document.getElementById("errorBox")?.remove();

        const div = document.createElement("div");
        div.id = "errorBox";
        div.innerHTML = html;

        document.getElementById("departmentForm").prepend(div);
    }
});
</script>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tabbuttons;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    tabbuttons = document.getElementsByClassName("tab-button");
    for (i = 0; i < tabbuttons.length; i++) {
        tabbuttons[i].classList.remove("active");
    }
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}
</script>
@endsection
