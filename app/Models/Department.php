<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
    'name','code','category','parent_department','status','established_date',
    'department_head','employee_id','email','contact_number','extension_number','reporting_to',
    'location','office_floor','total_employees','working_hours','working_days','department_type',
    'functions','compliance','certifications','security_level',
    'description','kpis','remarks'
];
}
