<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
    ];
    public $timestamps = true;

}
