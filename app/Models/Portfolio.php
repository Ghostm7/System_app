<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    protected $fillable = [
        'basic_information',
        'education',
        'work_experience',
        'skills',
        'personal_projects',
        'achievements',
        'review_status',
    ];
    
}

// app/Models/Portfolio.php

