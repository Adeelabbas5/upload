<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'description',
        'image_path',
        'link',
        'year',
        'screenshots',
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
