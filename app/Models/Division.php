<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends BaseModel
{
    protected $table = 'divisions';

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    protected $fillable = [
        'name',
        'description'
    ];
}
