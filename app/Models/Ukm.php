<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class Ukm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];
}
