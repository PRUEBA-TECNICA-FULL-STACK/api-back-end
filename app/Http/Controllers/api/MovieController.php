<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    function index()
    {

        return response()->json([
            'data' =>
                Movie::all()->toArray()
            ,
            'Response' => 'True',
        ]);
    }

    function store(Request $request)
    {
        $validatedData = $request->validate([
            'Title' => 'required|max:255',
            'Poster' => 'required|max:255',
            'Year' => 'required|integer',
            'imdbID' => 'required',

        ]);
        $movie = new Movie();
        $isExist = Movie::where('imdbID', $request->imdbID)->first();
        if ($isExist==null) {
            $movie->Title = $request->Title;
            $movie->Poster = $request->Poster;
            $movie->Year = $request->Year;
            $movie->imdbID = $request->imdbID;
            $movie->save();
        }

        return response()->json([
            'data' => [
                $isExist ==null ? $movie->toArray() : $isExist->toArray(),
            ],
            'Response' => 'True',


        ]);
    }
}
