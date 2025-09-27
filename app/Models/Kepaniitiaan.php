<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepaniitiaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_name',
        'start_date',
        'end_date',
    ];
}