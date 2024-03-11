<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nameJob',
        'descriptionJob',
        'requirementsJob',
        'salaryJob',
        'company_id'
    ];

    // Define la relación con el modelo Company.
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
