<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $with = ['job', 'division'];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
