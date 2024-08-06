<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasUuids;

    protected $rules = [];

    protected $fillable = [];

    public function rules(): array
    {
        return $this->rules;
    }

    public function getFillable(): array
    {
        return $this->fillable;
    }
}