<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'specialty_id'       
    ];
    public $timestamps = true;

    public function specialty(): BelongsTo
{
    return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
}

    public function scopeFindById(Builder $query, $serviceID): void
    {
        $query->where('id', $serviceID);
    }

    public function scopeFindBySpecialtyId(Builder $query, $specialtyID): void
    {
        $query->where('specialty_id', $specialtyID);
    }

    public function scopeOrderByTitleAsc(Builder $query): void
    {
        $query->orderBy('title');
    }
}
