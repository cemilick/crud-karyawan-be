<?php

namespace App\Models;

class Job extends BaseModel
{
    protected $table = 'karyawan_jobs';

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    protected $fillable = [
        'name',
        'description'
    ];
}
