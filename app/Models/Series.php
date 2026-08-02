<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Override;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cover'];

    protected $attributes = [
        'cover' => 'series_cover/default.jpg', // ou 'default-image.jpg'
    ];

    public function seasons(){
        return $this->hasMany(Season::class, 'series_id');
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}
