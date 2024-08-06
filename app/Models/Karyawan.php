<?php

namespace App\Models;

class Karyawan extends BaseModel
{
    protected $table = 'karyawans';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email'
    ];

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'job_id',
        'division_id'
    ];
}
