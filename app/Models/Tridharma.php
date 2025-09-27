<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tridharma extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'title', 'researcher_name', 'date'];
}
