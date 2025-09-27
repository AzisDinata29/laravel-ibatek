<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Magang extends Model
{
    use HasFactory;
    protected $fillable = ['company_name', 'position', 'start_date', 'end_date'];
}
