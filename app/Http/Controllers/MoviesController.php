<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Movie;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $name = "";
        $term = "";
        
        $query = $request->query();
        
        if(array_key_exists('name', $query)){
            $name = $query['name'];
        }

        if(array_key_exists('term', $query)) {
            $term = $query['term'];
        } 

            // cak je i ovo visak, jer ce ako su prazni query stringovi uhvatice sve filmove
            // $movies = Movie::all();

        if(array_key_exists('take', $query)){
            $take = $query['take'];
        }

        if(array_key_exists('skip', $query)) {
            $skip = $query['skip'];
        } 

        
        
        $movies = Movie::search($name, $term, $take=20, $skip=0);

        return $movies;

        // return view('index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $request->validate([
            'name' => 'required | unique:movies,name',
            'director' => 'required',
            'duration' => 'required | integer | min: 1 | max: 500',
            'imageUrl' => 'required | url',
            'releaseDate' => 'required | unique:movies,release_date',
        ]);
        // dd('kdfjbgsdkjg');
        $movie->name = $request->input('name');
        $movie->director = $request->input('director');
        $movie->image_url = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->release_date = $request->input('releaseDate');
        $movie->genres = $request->input('genres');
        $movie->save();
        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $request->validate([
            'name' => 'required | unique:movies',
            'director' => 'required',
            'duration' => 'required | integer | min: 1 | max: 500',
            'imageUrl' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'releaseDate' => 'required | unique:movies',
        ]);
    
        $movie->name = $request->input('name');
        $movie->director = $request->input('director');
        $movie->image_url = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->release_date = $request->input('releaseDate');
        $movie->genres = $request->input('genres');
        $movie->update();
       
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return $movie;
    }
}
