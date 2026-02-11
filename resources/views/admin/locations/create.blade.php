@extends('layouts.admin')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            background-color: #f8f9fa;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        header p {
            font-size: 1.1em;
            position: relative;
            z-index: 1;
            opacity: 0.95;
        }

        /* Stats Dashboard */
        .stats-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 30px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            transition: width 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .stat-card:hover::before {
            width: 100%;
            opacity: 0.1;
        }

        .stat-card.blue::before { background: #2196f3; }
        .stat-card.green::before { background: #4caf50; }
        .stat-card.orange::before { background: #ff9800; }
        .stat-card.purple::before { background: #9c27b0; }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            color: white;
        }

        .stat-icon.blue { background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%); }
        .stat-icon.green { background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%); }
        .stat-icon.orange { background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%); }
        .stat-icon.purple { background: linear-gradient(135deg, #9c27b0 0%, #e91e63 100%); }

        .stat-info h3 {
            font-size: 2em;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #7f8c8d;
            font-size: 0.95em;
            font-weight: 600;
        }

        /* Tabs */
        .tabs {
            display: flex;
            flex-wrap: wrap;
            background: white;
            padding: 20px 30px 0 30px;
            gap: 10px;
        }
        
        .tab-button {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border: none;
            outline: none;
            cursor: pointer;
            padding: 15px 25px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .tab-button:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-3px);
        }
        
        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .tab-button i {
            font-size: 1.2em;
        }
        
        /* Tab content */
        .tab-content {
            display: none;
            padding: 30px;
            background-color: white;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Section styling */
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #2c3e50;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .section-title i {
            font-size: 1.3em;
        }
        
        /* Card styling */
        .form-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateX(5px);
        }

        .form-card-title {
            font-size: 1.4em;
            margin-bottom: 20px;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-card-title i {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Form styling */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: #667eea;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Button styling */
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            justify-content: center;
            min-width: 150px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(244, 67, 54, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 152, 0, 0.4);
        }

        /* Table styling */
        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        thead th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
            transform: scale(1.01);
        }

        tbody td {
            padding: 15px;
            color: #2c3e50;
            font-size: 14px;
        }

        /* Badge styling */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-success {
            background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
            color: white;
        }

        .badge-purple {
            background: linear-gradient(135deg, #9c27b0 0%, #e91e63 100%);
            color: white;
        }

        /* Action buttons in table */
        .action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 5px;
            color: white;
        }

        .action-btn-edit {
            background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
        }

        .action-btn-view {
            background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        }

        .action-btn-delete {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* Location type icons */
        .location-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3em;
            color: white;
            margin-right: 10px;
        }

        .location-icon.headquarters { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .location-icon.regional { background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%); }
        .location-icon.branch { background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%); }
        .location-icon.warehouse { background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%); }
        .location-icon.plant { background: linear-gradient(135deg, #9c27b0 0%, #e91e63 100%); }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-dashboard {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .tabs {
                flex-direction: column;
            }

            .tab-button {
                width: 100%;
                border-radius: 10px;
                margin-bottom: 5px;
            }

            header h1 {
                font-size: 1.8em;
            }

            .section-title {
                font-size: 1.4em;
            }
        }

        /* Info boxes */
        .info-box {
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 5px solid;
        }

        .info-box.info {
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.1) 0%, rgba(33, 203, 243, 0.1) 100%);
            border-left-color: #2196f3;
        }

        .info-box.success {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(139, 195, 74, 0.1) 100%);
            border-left-color: #4caf50;
        }

        .info-box.warning {
            background: linear-gradient(135deg, rgba(255, 152, 0, 0.1) 0%, rgba(255, 193, 7, 0.1) 100%);
            border-left-color: #ff9800;
        }

        .info-box i {
            font-size: 2em;
        }

        .info-box.info i { color: #2196f3; }
        .info-box.success i { color: #4caf50; }
        .info-box.warning i { color: #ff9800; }
    </style>

    <div class="container">
        <!-- Header -->
        <header>
            <h1><i class="fas fa-map-marked-alt"></i> Location Master Module</h1>
            <p>Comprehensive Location Management System for Nuggetts EAM</p>
        </header>

        <!-- Stats Dashboard -->
        <div class="stats-dashboard">
            <div class="stat-card blue">
                <div class="stat-icon blue">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-info">
                    <h3>128</h3>
                    <p>Total Locations</p>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>115</h3>
                    <p>Active Locations</p>
                </div>
            </div>

            <div class="stat-card orange">
                <div class="stat-icon orange">
                    <i class="fas fa-warehouse"></i>
                </div>
                <div class="stat-info">
                    <h3>34</h3>
                    <p>Warehouses</p>
                </div>
            </div>

            <div class="stat-card purple">
                <div class="stat-icon purple">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <div class="stat-info">
                    <h3>18</h3>
                    <p>Countries</p>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'addLocation')">
                <i class="fas fa-plus-circle"></i> Add New Location
            </button>
            <button class="tab-button" onclick="openTab(event, 'viewLocations')">
                <i class="fas fa-list"></i> View All Locations
            </button>
            <button class="tab-button" onclick="openTab(event, 'analytics')">
                <i class="fas fa-chart-pie"></i> Analytics
            </button>
        </div>

        <!-- Tab Content: Add Location -->
        <div id="addLocation" class="tab-content active">
            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-map-pin"></i>
                    Create New Location
                </h2>

                <!-- Basic Information Card -->
                <div class="form-card">
                    <h3 class="form-card-title">
                        <i class="fas fa-info-circle"></i>
                        Basic Information
                    </h3>
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-id-badge"></i>
                                    Location ID (Auto-generated)
                                </label>
                                <input type="text" value="LOC-2026-001" readonly style="background: #f5f5f5;">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-building"></i>
                                    Location Name
                                </label>
                                <input type="text" placeholder="Enter location name" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-code"></i>
                                    Location Code
                                </label>
                                <input type="text" placeholder="e.g., MUM-HQ-01" required style="text-transform: uppercase;">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-layer-group"></i>
                                    Location Type
                                </label>
                                <select required>
                                    <option value="">Select type</option>
                                    <option value="headquarters">🏢 Headquarters</option>
                                    <option value="regional">🏛️ Regional Office</option>
                                    <option value="branch">🏪 Branch Office</option>
                                    <option value="warehouse">📦 Warehouse</option>
                                    <option value="plant">🏭 Plant / Factory</option>
                                    <option value="site">🚧 Construction Site</option>
                                    <option value="retail">🛍️ Retail Store</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-folder-tree"></i>
                                    Parent Location
                                </label>
                                <select>
                                    <option value="">None (Top Level)</option>
                                    <option value="hq-mumbai">HQ - Mumbai</option>
                                    <option value="ro-west">Regional Office - West</option>
                                    <option value="ro-north">Regional Office - North</option>
                                    <option value="ro-south">Regional Office - South</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-toggle-on"></i>
                                    Status
                                </label>
                                <select required>
                                    <option value="">Select status</option>
                                    <option value="active" selected>✅ Active</option>
                                    <option value="inactive">❌ Inactive</option>
                                    <option value="under-construction">🚧 Under Construction</option>
                                    <option value="maintenance">🔧 Under Maintenance</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Address Details Card -->
                <div class="form-card">
                    <h3 class="form-card-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Complete Address Details
                    </h3>
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-home"></i>
                                    Address Line 1
                                </label>
                                <input type="text" placeholder="Building number, Street name" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-road"></i>
                                    Address Line 2
                                </label>
                                <input type="text" placeholder="Area, Landmark (optional)">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-location-dot"></i>
                                    Locality / Area
                                </label>
                                <input type="text" placeholder="Enter locality" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-city"></i>
                                    City
                                </label>
                                <input type="text" placeholder="Enter city" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-map"></i>
                                    District
                                </label>
                                <input type="text" placeholder="Enter district" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-flag"></i>
                                    State / Province
                                </label>
                                <input type="text" placeholder="Enter state" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-globe"></i>
                                    Country
                                </label>
                                <input type="text" value="India" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-mail-bulk"></i>
                                    PIN / ZIP Code
                                </label>
                                <input type="text" placeholder="Enter postal code" maxlength="6" required>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Geographic Coordinates Card -->
                <div class="form-card">
                    <h3 class="form-card-title">
                        <i class="fas fa-compass"></i>
                        Geographic Coordinates & Area
                    </h3>
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-location-crosshairs"></i>
                                    Latitude
                                </label>
                                <input type="text" placeholder="e.g., 19.0760">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-location-crosshairs"></i>
                                    Longitude
                                </label>
                                <input type="text" placeholder="e.g., 72.8777">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-ruler-combined"></i>
                                    Total Area (sq. ft.)
                                </label>
                                <input type="number" placeholder="Enter total area" min="0">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-building-user"></i>
                                    Built-up Area (sq. ft.)
                                </label>
                                <input type="number" placeholder="Enter built-up area" min="0">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-mountain-sun"></i>
                                    Elevation (meters)
                                </label>
                                <input type="number" placeholder="Elevation above sea level" min="0">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-map-location-dot"></i>
                                    Time Zone
                                </label>
                                <select>
                                    <option value="">Select time zone</option>
                                    <option value="ist">IST (UTC+5:30)</option>
                                    <option value="pst">PST (UTC+8:00)</option>
                                    <option value="est">EST (UTC-5:00)</option>
                                    <option value="gmt">GMT (UTC+0:00)</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                

                <!-- Contact Information Card -->
                <div class="form-card">
                    <h3 class="form-card-title">
                        <i class="fas fa-address-book"></i>
                        Contact Information
                    </h3>
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-user-tie"></i>
                                    Location Manager
                                </label>
                                <input type="text" placeholder="Manager name" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-id-card"></i>
                                    Manager Employee ID
                                </label>
                                <input type="text" placeholder="Employee ID">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-mobile-alt"></i>
                                    Primary Contact Number
                                </label>
                                <input type="tel" placeholder="10-digit mobile" pattern="[0-9]{10}" maxlength="10" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-phone"></i>
                                    Alternate Contact
                                </label>
                                <input type="tel" placeholder="Alternate number" pattern="[0-9]{10}" maxlength="10">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-envelope"></i>
                                    Official Email ID
                                </label>
                                <input type="email" placeholder="location@example.com" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-fax"></i>
                                    Fax Number
                                </label>
                                <input type="text" placeholder="Fax (optional)">
                            </div>
                        </div>
                    </form>
                </div>

               
                <!-- Additional Information Card -->
                <div class="form-card">
                    <h3 class="form-card-title">
                        <i class="fas fa-sticky-note"></i>
                        Additional Information
                    </h3>
                    <form>
                        <div class="form-group">
                            <label>
                                <i class="fas fa-comment-dots"></i>
                                Remarks / Notes
                            </label>
                            <textarea placeholder="Enter any additional information, special instructions, or remarks about this location..." rows="5"></textarea>
                        </div>

                        <div class="info-box info">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Note:</strong> All fields marked with asterisk (*) are mandatory. Ensure all information is accurate before submitting.
                            </div>
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Save Location
                            </button>
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-check-double"></i>
                                Save & Add Another
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fas fa-eraser"></i>
                                Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tab Content: View Locations -->
        <div id="viewLocations" class="tab-content">
            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    All Registered Locations
                </h2>

                <div class="info-box success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Total Locations:</strong> 128 registered locations across 18 countries.
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Location ID</th>
                                <th>Location Name</th>
                                <th>Type</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>LOC-001</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon headquarters">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        Head Office - Mumbai
                                    </div>
                                </td>
                                <td><span class="badge badge-purple">Headquarters</span></td>
                                <td>Mumbai</td>
                                <td>Maharashtra</td>
                                <td>India</td>
                                <td>Rajesh Kumar</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-002</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon regional">
                                            <i class="fas fa-landmark"></i>
                                        </span>
                                        Regional Office - Delhi
                                    </div>
                                </td>
                                <td><span class="badge badge-info">Regional Office</span></td>
                                <td>New Delhi</td>
                                <td>Delhi</td>
                                <td>India</td>
                                <td>Priya Sharma</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-003</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon branch">
                                            <i class="fas fa-store"></i>
                                        </span>
                                        Branch Office - Pune
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Branch</span></td>
                                <td>Pune</td>
                                <td>Maharashtra</td>
                                <td>India</td>
                                <td>Amit Patel</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-004</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon warehouse">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                        Warehouse - Bangalore
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">Warehouse</span></td>
                                <td>Bangalore</td>
                                <td>Karnataka</td>
                                <td>India</td>
                                <td>Sneha Reddy</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-005</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon plant">
                                            <i class="fas fa-industry"></i>
                                        </span>
                                        Manufacturing Plant - Ahmedabad
                                    </div>
                                </td>
                                <td><span class="badge badge-purple">Plant</span></td>
                                <td>Ahmedabad</td>
                                <td>Gujarat</td>
                                <td>India</td>
                                <td>Vikram Singh</td>
                                <td><span class="badge badge-warning">Maintenance</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-006</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon branch">
                                            <i class="fas fa-store"></i>
                                        </span>
                                        Branch Office - Chennai
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Branch</span></td>
                                <td>Chennai</td>
                                <td>Tamil Nadu</td>
                                <td>India</td>
                                <td>Deepak Nair</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-007</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon warehouse">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                        Distribution Center - Kolkata
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">Warehouse</span></td>
                                <td>Kolkata</td>
                                <td>West Bengal</td>
                                <td>India</td>
                                <td>Ananya Das</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LOC-008</strong></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <span class="location-icon branch">
                                            <i class="fas fa-store"></i>
                                        </span>
                                        Branch Office - Hyderabad
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Branch</span></td>
                                <td>Hyderabad</td>
                                <td>Telangana</td>
                                <td>India</td>
                                <td>Karthik Reddy</td>
                                <td><span class="badge badge-danger">Inactive</span></td>
                                <td>
                                    <button class="action-btn action-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="action-btn action-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn action-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="info-box warning" style="margin-top: 20px;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Note:</strong> Use the action buttons to view details, edit information, or delete locations. Deleted locations cannot be recovered.
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Content: Analytics -->
        <div id="analytics" class="tab-content">
            <div class="section">
                <h2 class="section-title">
                    <i class="fas fa-chart-pie"></i>
                    Location Analytics Dashboard
                </h2>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
                    <div class="form-card">
                        <h3 class="form-card-title">
                            <i class="fas fa-building"></i>
                            Locations by Type
                        </h3>
                        <div style="padding: 20px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><i class="fas fa-building" style="color: #667eea;"></i> Headquarters</span>
                                <strong style="color: #667eea;">5</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><i class="fas fa-landmark" style="color: #2196f3;"></i> Regional Offices</span>
                                <strong style="color: #2196f3;">18</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><i class="fas fa-store" style="color: #4caf50;"></i> Branches</span>
                                <strong style="color: #4caf50;">42</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><i class="fas fa-warehouse" style="color: #ff9800;"></i> Warehouses</span>
                                <strong style="color: #ff9800;">34</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span><i class="fas fa-industry" style="color: #9c27b0;"></i> Plants</span>
                                <strong style="color: #9c27b0;">29</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <h3 class="form-card-title">
                            <i class="fas fa-globe-asia"></i>
                            Top 5 Countries
                        </h3>
                        <div style="padding: 20px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span>🇮🇳 India</span>
                                <strong>68</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span>🇺🇸 United States</span>
                                <strong>24</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span>🇬🇧 United Kingdom</span>
                                <strong>12</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span>🇦🇪 UAE</span>
                                <strong>10</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>🇸🇬 Singapore</span>
                                <strong>8</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <h3 class="form-card-title">
                            <i class="fas fa-chart-line"></i>
                            Status Overview
                        </h3>
                        <div style="padding: 20px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><span class="badge badge-success">Active</span></span>
                                <strong>115</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><span class="badge badge-warning">Under Maintenance</span></span>
                                <strong>8</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                <span><span class="badge badge-info">Under Construction</span></span>
                                <strong>3</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span><span class="badge badge-danger">Inactive</span></span>
                                <strong>2</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-box info" style="margin-top: 30px;">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>Analytics Summary:</strong> This dashboard provides real-time insights into your location network. Data is updated automatically as locations are added or modified.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            // Hide all tab content
            const tabContents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }
            
            // Remove active class from all tab buttons
            const tabButtons = document.getElementsByClassName("tab-button");
            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }
            
            // Show the selected tab content and mark button as active
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>

@endsection
