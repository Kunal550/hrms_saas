<?php

namespace App\Models;

use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    use BelongsToCompany;

    protected $fillable = [
        'employee_id',
        'company_id',
        'date',
        'clock_in',
        'clock_out',
        'total_hours',
    ];

    // 🔥 This is the key fix
    protected $casts = [
        'date' => 'date',          // Carbon instance
        'clock_in' => 'datetime',  // Carbon instance
        'clock_out' => 'datetime', // Carbon instance
    ];

    // Relation to Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
