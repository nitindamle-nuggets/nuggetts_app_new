<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id','location_name','location_code','location_type','parent_location','status',
        'address1','address2','locality','city','district','state','country','pincode',
        'latitude','longitude','total_area','builtup_area','elevation','timezone',
        'manager_name','manager_emp_id','primary_contact','alternate_contact','email','fax',
        'remarks'
    ];
}
