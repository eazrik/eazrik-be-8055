<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    protected ImageStoreService $imageStoreService;

    /**
     * __construct function
     *
     * @param ImageStoreService $imageStoreService
     */
    public function __construct(ImageStoreService $imageStoreService)
    {
        $this->imageStoreService = $imageStoreService;
    }

    /**
     * allMovieShow function
     *
     * @return mixed
     */
    public function allMovies(): mixed
    {
        return Movie::paginate(10);
    }

    /**
     * topMovies function
     *
     * @param text $release
     * @return mixed
     */
    public function newMovies($release): mixed
    {
        return Movie::where('release', '<', $release)->get();
    }

    /**
     * topMovies function
     *
     * @return mixed
     */
    public function topMovies(): mixed
    {
        return Movie::orderBy('created_at', 'desc')->limit(5)->get();
    }

    /**
     * genre function
     * 
     * @param text $genre
     * @return mixed
     */
    public function genre($genre): mixed
    {
        return Movie::where('genre', '=', $genre)->paginate(10);
    }

    /**
     * timeSlot function
     * 
     * @param text $start
     * @param text $end
     * @return mixed
     */
    public function timeSlot($start, $end): mixed
    {
        return Movie::whereBetween('start_at', [$start, $end])
            ->orWhereBetween('end_at', [$start, $end])
            ->orWhereRaw('? BETWEEN start_at and end_at', [$start])
            ->orWhereRaw('? BETWEEN start_at and end_at', [$end])->get();
    }

    /**
     * genre function
     * 
     * @param text $specificMovieTheatre
     * @return mixed
     */
    public function specificMovieTheatre($specificMovieTheatre): mixed
    {
        return Movie::where('theater_name', '=', $specificMovieTheatre)->paginate(10);
    }

    /**
     * performer function
     * 
     * @param text $performer
     * @return mixed
     */
    public function performer($performer): mixed
    {
        return Movie::where('performer', '=', $performer)->paginate(10);
    }

    /**
     * store function
     *
     * @param Request $request
     * @return void
     */
    public function store($request)
    {
        $imagePath = $this->imageStoreService->handleBase64('public/movies', $request->base64Data);

        return Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath !== false ? $imagePath : 'public/movies/default.jpg',
            'genre' => $request->genre,
            'performer' => $request->performer,
            'director' => $request->director,
            'theater_name' => $request->theater_name,
            'release' => $request->release,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'length' => $request->length,
        ]);
    }

    /**
     * update function
     *
     * @param Movie $movie
     * @param Request $request
     * @return void
     */
    public function update($movie, $request)
    {
        if ($request->hasFile('image')) {
            if ($movie->image) {
                Storage::delete($movie->image);
            }
            $imagePath = $this->imageStoreService->handle('public/movies', $request->file('image'));
        }

        return $movie->update([
            'title'       => $request->filled('title') ? $request->title : $movie->title,
            'description' => $request->filled('description') ? $request->description : $movie->description,
            'image'       => $request->hasFile('image') ? $imagePath : $movie->image,
            'genre' => $request->filled('genre') ? $request->genre : $movie->genre,
            'performer' => $request->filled('performer') ? $request->performer : $movie->performer,
            'director' => $request->filled('director') ? $request->director : $movie->director,
            'theater_name' => $request->filled('theater_name') ? $request->theater_name : $movie->theater_name,
            'theater_name' => $request->filled('theater_name') ? $request->theater_name : $movie->theater_name,
            'release' => $request->filled('release') ? $request->release : $movie->release,
            'start_at' => $request->filled('start_at') ? $request->start_at : $movie->start_at,
            'end_at' => $request->filled('end_at') ? $request->end_at : $movie->end_at,
            'length' => $request->filled('length') ? $request->length : $movie->length,
        ]);
    }

    /**
     * update function
     *
     * @param Movie $movie
     * @param Request $request
     * @return void
     */
    public function giveRating($movie, $request)
    {
        return $movie->update([
            'ratings' => $request->filled('ratings') ? $request->ratings : $movie->ratings,
        ]);
    }

    /**
     * delete function
     *
     * @param Movie $movie
     * @return void
     */
    public function delete($movie)
    {
        if ($movie->image) {
            Storage::delete($movie->image);
        }

        return $movie->delete();
    }

    /**
     * rating function
     *
     * @param Movie $movie
     * @param Request $request
     * @return void
     */
    public function rating($movie, $request)
    {
        return $movie->update([
            'ratings' => $request->filled('ratings') ? $request->ratings : $movie->ratings,
        ]);
    }
}
