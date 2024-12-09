<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criteria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'weight',
        'type',
    ];

    public function subcriterias(): HasMany
    {
        return $this->hasMany(Subcriteria::class);
    }
}
