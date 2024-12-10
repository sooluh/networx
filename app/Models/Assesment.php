<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assesment extends Model
{
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'subcriteria_id',
    ];

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function subcriteria(): BelongsTo
    {
        return $this->belongsTo(Subcriteria::class);
    }
}
