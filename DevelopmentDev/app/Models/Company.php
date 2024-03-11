<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nit',
        'nameCompany',
        'descriptionCompany',
        'industryCompany',
        'LocationCompany',
        'numberCompany',
        'photo_logo',
        'status',
        'confirmation_code',
        'authorized_by'
    ];

    public function documents()
    {
        return $this->hasMany(Documents::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relación con el modelo User para el campo 'authorized_by'
    public function authorizedBy()
    {
        return $this->belongsTo(User::class, 'authorized_by');
    }
}
