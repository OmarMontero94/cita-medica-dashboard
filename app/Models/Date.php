<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $table = 'medics_services';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'date',
        'approved',
        'medic_id',
        'patient_id',
        'service_id',

    ];
    public $timestamps = true;

    public function medic(): BelongsTo
    {
        return $this->belongsTo(Medic::class,'medic_id','id');
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}