<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_id',
        'leave_type',
        'from_date',
        'to_date',
        'reason',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
