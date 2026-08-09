<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Override;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cover'];
    protected $appends = ['links'];

    protected $attributes = [
        'cover' => 'series_cover/default.jpg', // ou 'default-image.jpg'
    ];

    public function seasons(){
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes() {
        return $this->hasManyThrough(Episode::class, Season::class);
    }
    

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }

    protected function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/v1/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/v1/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/v1/series/{$this->id}/episodes"
                ],
            ],
        );
    }
}
