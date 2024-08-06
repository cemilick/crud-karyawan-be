<?php

namespace App\Models;

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
