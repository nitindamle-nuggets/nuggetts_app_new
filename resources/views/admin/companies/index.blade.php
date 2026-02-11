@extends('layouts.admin')

@section('content')
<style>
    * {margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
    .container {background:#fff; border-radius:12px; box-shadow:0 10px 40px rgba(0,0,0,0.15); overflow:hidden; margin:20px;}
    .header {background:linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color:#fff; padding:30px 35px; display:flex; justify-content:space-between; align-items:center;}
    .header h1 {font-size:32px; font-weight:700; margin:0;}
    .header-actions {display:flex; gap:15px;}
    .btn {padding:12px 28px; border:none; border-radius:6px; font-size:14px; font-weight:600; cursor:pointer; transition:all 0.3s ease;}
    .btn-primary {background:#28a745; color:#fff;}
    .btn-primary:hover {background:#218838; transform:translateY(-2px); box-shadow:0 4px 12px rgba(40,167,69,0.3);}
    .btn-secondary {background:#6c757d; color:#fff;}
    .btn-secondary:hover {background:#5a6268;}
    .section {padding:35px;}
    .section-title {font-size:22px; font-weight:700; color:#1e3c72; margin-bottom:25px; padding-bottom:12px; border-bottom:3px solid #1e3c72; display:flex; align-items:center; gap:12px;}
    .section-title i {font-size:24px; color:#2a5298;}
    .alert {padding:18px 20px; border-radius:8px; margin-bottom:25px; border-left:4px solid; font-weight:500;}
    .alert-success {background:#d4edda; color:#155724; border-left-color:#28a745;}
    .stat-cards {display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:20px; margin-bottom:35px;}
    .stat-card {background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:#fff; padding:25px; border-radius:10px; box-shadow:0 4px 15px rgba(102,126,234,0.3);}
    .stat-card.blue {background:linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);}
    .stat-card.green {background:linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);}
    .stat-card h3 {font-size:28px; font-weight:700; margin:0;}
    .stat-card p {font-size:14px; opacity:0.95; margin:8px 0 0 0;}
    .table-container {overflow-x:auto; border-radius:8px; border:1px solid #dee2e6;}
    table {width:100%; border-collapse:collapse; background:#fff;}
    table thead {background:#1e3c72; color:#fff;}
    table thead th {padding:18px 15px; text-align:left; font-weight:600; font-size:13px; text-transform:uppercase; letter-spacing:0.5px;}
    table tbody td {padding:15px; border-bottom:1px solid #dee2e6; font-size:14px;}
    table tbody tr {transition:all 0.2s ease;}
    table tbody tr:hover {background:#f8f9fa; transform:scale(1.01);}
    .badge {padding:6px 12px; border-radius:12px; font-size:12px; font-weight:600; display:inline-block;}
    .badge-success {background:#d4edda; color:#155724;}
    .badge-warning {background:#fff3cd; color:#856404;}
    .badge-danger {background:#f8d7da; color:#721c24;}
    .action-btn {padding:8px 14px; border:none; border-radius:6px; cursor:pointer; font-size:12px; font-weight:600; margin-right:6px; transition:all 0.2s ease;}
    .action-btn-edit {background:#007bff; color:#fff;}
    .action-btn-edit:hover {background:#0056b3; box-shadow:0 2px 8px rgba(0,123,255,0.3);}
    .action-btn-delete {background:#dc3545; color:#fff;}
    .action-btn-delete:hover {background:#c82333; box-shadow:0 2px 8px rgba(220,53,69,0.3);}
    .empty-state {text-align:center; padding:60px 20px; color:#999; font-size:16;}
    .empty-state i {font-size:48px; margin-bottom:15px; opacity:0.5;}
</style>

<div class="container">
    <div class="header">
        <h1>Company Management</h1>
        <div class="header-actions">
            <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">+ Add Company</a>
        </div>
    </div>

    <div class="section">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="section-title">Company List</div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>{{ $company->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="action-btn action-btn-edit">Edit</button>
                                <button class="action-btn action-btn-delete">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">No companies found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
