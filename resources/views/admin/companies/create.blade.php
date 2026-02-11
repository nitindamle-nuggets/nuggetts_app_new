@extends('layouts.admin')

@section('content')
<style>
    * {margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
    .container {max-width:1200px; margin:20px auto; background:#fff; border-radius:12px; box-shadow:0 10px 40px rgba(0,0,0,0.15); overflow:hidden;}
    .header {background:linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color:#fff; padding:35px; display:flex; align-items:center; gap:15px;}
    .header h1 {font-size:32px; font-weight:700; margin:0;}
    .section {padding:35px;}
    .section-title {font-size:22px; font-weight:700; color:#1e3c72; margin-bottom:25px; padding-bottom:12px; border-bottom:3px solid #1e3c72; display:flex; align-items:center; gap:12px;}
    .section-title i {font-size:24px; color:#2a5298;}
    .subsection-card {background:#f8f9fa; border:1px solid #dee2e6; border-radius:8px; margin-bottom:20px;}
    .card-content {padding:25px;}
    .form-grid {display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:22px; margin-bottom:25px;}
    .form-group {display:flex; flex-direction:column;}
    .form-group label {font-size:14px; font-weight:600; color:#2c3e50; margin-bottom:8px;}
    .required {color:#dc3545;}
    .form-group input, .form-group select, .form-group textarea {width:100%; padding:12px 15px; border:2px solid #dee2e6; border-radius:6px; font-size:14px; transition:all 0.3s ease;}
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {outline:none; border-color:#1e3c72; box-shadow:0 0 0 3px rgba(30,60,114,0.1);}
    .form-group textarea {resize:vertical; min-height:100px;}
    .info-box {padding:18px 20px; border-radius:8px; margin-bottom:25px; border-left:4px solid #2a5298; background:#e7f3ff; color:#1e3c72;}
    .action-buttons {display:flex; gap:20px; margin-top:35px; flex-wrap:wrap;}
    .btn {padding:14px 32px; border:none; border-radius:6px; font-size:14px; font-weight:600; cursor:pointer; transition:all 0.3s ease; min-width:160px;}
    .btn-primary {background:#1e3c72; color:#fff;}
    .btn-primary:hover {background:#152b54; transform:translateY(-2px); box-shadow:0 4px 12px rgba(30,60,114,0.3);}
    .btn-secondary {background:#6c757d; color:#fff;}
    .btn-secondary:hover {background:#5a6268; transform:translateY(-2px);}
    .error-box {background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; padding:18px 20px; border-radius:6px; margin-bottom:25px; border-left:4px solid #dc3545;}
    .error-box ul {margin:12px 0 0 0; padding-left:20px;}
    .error-message {display:block; color:#dc3545; font-size:12px; margin-top:6px;}
</style>

<div class="container">
    <div class="header">
        <h1><i class="fas fa-plus-circle"></i> Add New Company</h1>
    </div>

    <div class="section">
        @if ($errors->any())
            <div class="error-box">
                <strong>Errors found:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.companies.store') }}" method="POST" id="companyForm" novalidate>
            @csrf

            <div class="section">
                <div class="section-title">
                    <i class="fas fa-building"></i>
                    Company Information
                </div>
                <div class="subsection-card">
                    <div class="card-content">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Company Name <span class="required">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" minlength="2" maxlength="255" required>
                                @error('name')<span class="error-message">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Company
                </button>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('companyForm').addEventListener('submit', function(e) {
        const name = document.querySelector('input[name="name"]').value.trim();
        if (name.length < 2 || name.length > 255) {
            e.preventDefault();
            alert('Company name must be 2-255 characters');
        }
    });
</script>
@endsection
