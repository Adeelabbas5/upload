<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'details',
        'icon',
        'resource_link',
        'resource_path',
        'screenshots',
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
