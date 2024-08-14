<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'description',
        'salary',
        'company',
        'location',
        'image',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
