<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Patient extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'phone',
        'user_id'
    ];
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

