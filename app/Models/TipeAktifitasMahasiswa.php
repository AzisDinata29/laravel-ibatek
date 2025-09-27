<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TipeAktifitasMahasiswa extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name);
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = $model->generateUniqueSlug($model->name, $model->id);
            }
        });
    }

   private function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name, '-');
        $original = $slug;
        $counter = 1;

        while (
            self::where('slug', $slug)
                ->when($ignoreId, function ($q) use ($ignoreId) {
                    return $q->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}
