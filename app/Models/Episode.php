<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    public $timestamps = false;
    protected $fillable = ['number'];


    public function season(){
        return $this->belongsTo(Season::class, 'episode_id');
    }

    // public function scopeWatched(Builder $query){
    //     $query->where('watched',true);
    // }

    // protected function watched(): Attribute {
    //     //return Attribute::make();
    //     return new Attribute(
    //         get: fn ($watched) => (bool) $watched,
    //         set: fn ($watched) => (bool) $watched
    //     );
    // }

    protected $casts = [
        'watched' => 'boolean',
    ];
    
}
