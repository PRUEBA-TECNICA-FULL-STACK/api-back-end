<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'ratings';
    protected $fillable = [
        'rating',
        'movie_id',
        'user_id',

    ];

    public function movie()
    {
         return $this->belongsTo(Movie::class,'movie_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($rating) {
            if ($rating->rating < 1 || $rating->rating > 5) {
                // Cancel the save operation if the rating is not within the desired range
                return false;
            }
        });
    }
}
