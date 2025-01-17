<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicService extends Model
{
    protected $table = 'medics_services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'medic_id',
        'service_id',
        'price'
    ];
    public $timestamps = true;

    public function medic(): BelongsTo
    {
        return $this->belongsTo(Medic::class,'medic_id','id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function scopeFindByMedicId(Builder $query, $medicID): void
    {
        $query->where('medic_id', $medicID);
    }
}
