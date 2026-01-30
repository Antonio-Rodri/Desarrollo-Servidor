<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\MovieFactory;

#[UseFactory(MovieFactory::class)]
class Movie extends Model
{
    protected $table = 'movies';

    public static function updateMovie($id, $data)
    {
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->director = $data['director'];
        $movie->year = $data['year'];
        $movie->poster = $data['poster'];
        $movie->rented = $data['rented'];
        $movie->synopsis = $data['synopsis'];
        $movie->save();
    }

    public static function deleteMovie($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
    }

    public static function createMovie($data)
    {
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->director = $data['director'];
        $movie->year = $data['year'];
        $movie->poster = $data['poster'];
        $movie->rented = $data['rented'];
        $movie->synopsis = $data['synopsis'];
        $movie->save();
    }
}
