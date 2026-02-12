<?php

namespace App\Models;

use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, BelongsToCompany;

    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'department',
        'date_of_joining',
        'status',
        'user_id',
        'company_id'
    ];

    protected $casts = [
        'date_of_joining' => 'date', // ✅ ensures format() works
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(LeaveModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
