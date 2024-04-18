<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'movies';
    protected $fillable = [
        'Title',
        'Poster',
        'Year',
        'imdbID',
    ];
    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function getRatingAttribute(){
         return $this->ratings()->avg('rating');
    }
    public function toArray()
    {

        return [
            'id' => $this->id,
            'Title' => $this->Title,
            'Poster' => $this->Poster,
            'Year' => $this->Year,
            'imdbID' => $this->imdbID,
            'Ratings' => $this->getRatingAttribute(),
        ];

    }

}
