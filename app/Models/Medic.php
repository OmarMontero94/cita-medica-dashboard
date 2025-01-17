<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medic extends Model
{
    protected $table = 'medics';
    protected $primaryKey = 'id';

    protected $fillable = [
        'phone',
        'user_id',
        'location_id',
        'specialty_id',
        'verified_at',
    ];
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class,'id','location_id');
    }

    public function specialty(): HasOne
    {
        return $this->hasOne(Specialty::class,'id','specialty_id');
    }

    public function scopeFindById(Builder $query, $medicID): void
    {
        $query->where('id', $medicID);
    }

    public function scopeFindBySpecialtyId(Builder $query, $specialtyID): void
    {
        $query->where('user_id', $specialtyID);
    }

    public function scopeFindByUserId(Builder $query, $userID): void
    {
        $query->where('user_id', $userID);
    }

}
