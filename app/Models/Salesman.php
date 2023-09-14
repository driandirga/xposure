<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salesman extends Model
{
    use HasFactory;

    protected $table = 'salesmen';

    protected $fillable = [
        'name',
        'initial',
        'address',
        'phone',
        'active',
    ];

    public  function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
