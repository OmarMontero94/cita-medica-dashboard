<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
    ];
    public $timestamps = true;


    public function scopeFindById(Builder $query, $specialtyID): void
    {
        $query->where('id', $specialtyID);
    }

    public function scopeOrderByTitleAsc(Builder $query): void
    {
        $query->orderBy('title');
    }
}
