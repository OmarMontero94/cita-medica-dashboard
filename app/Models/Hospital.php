<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hospital extends Model
{
    protected $table = 'hospitals';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'phone',
        'user_id',
        'location_id',
        

    ];
    public $timestamps = true;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function location(): HasOne
    {
        return $this->hasOne(Location::class,'location_id','id');
    }

}
