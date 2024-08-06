<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilterBase;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // filter scope
    public function scopeFilter(Builder $builder, QueryFilterBase $filters) {
        return $filters->apply($builder);
    }
}
