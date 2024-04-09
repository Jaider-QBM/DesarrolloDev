<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'document_type',
        'url_document',
        'review_status'
    ];

    // Define la relación con el modelo Company.
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
