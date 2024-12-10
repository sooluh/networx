<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternative extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
    ];

    public function assesments(): HasMany
    {
        return $this->hasMany(Assesment::class);
    }
}
