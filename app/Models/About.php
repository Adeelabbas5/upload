<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'heading',
        'role',
        'language',
        'birthday',
        'location',
        'freelance_status',
        'description',
        'phone',
        'email',
        'photo_path',
        'cv_path',
    ];
}
