<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'hidden', 'budget_id', 'user_id',
    ];

    public function budget(): BelongsTo {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

//    public function scopeFilter(Builder $builder, QueryFilter $filters) {
//        return $filters->apply($builder);
//    }
}
