<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasUuids, HasFactory;

    protected $rules = [];

    protected $fillable = [];

    protected $filterable = [];

    public function rules(): array
    {
        return $this->rules;
    }

    public function getFillable(): array
    {
        return $this->fillable;
    }

    public function getFilterable(): array
    {
        return $this->filterable;
    }
}