<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{

    public function getIndex()
    {
        return view('catalog.index')->with('arrayPeliculas', Movie::all());
    }

    public function getShow($id)
    {
        return view('catalog.show')->with('id', $id)->with('arrayPeliculas', Movie::all());
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        return view('catalog.edit')->with('Pelicula', Movie::findOrFail($id))->with('id', $id);
    }

    public function postCreate(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->year = $request->year;
        $movie->poster = $request->poster;
        $movie->rented = $request->rented;
        $movie->synopsis = $request->synopsis;
        $movie->save();
        return redirect()->route('catalog');
    }

    public function putEdit(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->year = $request->year;
        $movie->poster = $request->poster;
        $movie->rented = $request->rented;
        $movie->synopsis = $request->synopsis;
        $movie->save();
        return redirect()->route('catalog');
    }
}
