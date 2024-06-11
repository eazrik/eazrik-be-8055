<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class MovieController extends Controller
{
    protected MovieService $movieService;

    /**
     * __construct function
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * allMovies function
     *
     * @return ApiSuccessResponse
     */
    public function allMovies(): ApiSuccessResponse
    {
        $data = $this->movieService->allMovies();
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'All Movies data Show'],
            200
        );
    }

    /**
     * newMovies function
     *
     * @param Request $request
     * @return void
     */
    public function newMovies(Request $request)
    {
        $data = $this->movieService->newMovies($request->release);
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'New Movie data Show'],
            200
        );
    }

    /**
     * topMovies function
     *
     * @return void
     */
    public function topMovies()
    {
        $data = $this->movieService->topMovies();
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'Top Movie data Show'],
            200
        );
    }

    /**
     * genre function
     *
     * @param Request $request
     * @return void
     */
    public function genre(Request $request)
    {
        $data = $this->movieService->genre($request->genre);
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'Genre Movie data Show'],
            200
        );
    }

    /**
     * timeSlot function
     *
     * @param Request $request
     * @return void
     */
    public function timeSlot(Request $request)
    {
        $data = $this->movieService->timeSlot($request->start_at, $request->end_at);
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'Time Slot Movie data Show'],
            200
        );
    }

    /**
     * specificMovieTheatre function
     *
     * @param Request $request
     * @return void
     */
    public function specificMovieTheatre(Request $request)
    {
        $data = $this->movieService->specificMovieTheatre($request->theater_name);
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'Specific Movie Theatre data Show'],
            200
        );
    }

    /**
     * performer function
     *
     * @param Request $request
     * @return void
     */
    public function performer(Request $request)
    {
        $data = $this->movieService->performer($request->performer);
        $formatedData = MovieResource::collection($data)->response()->getData();

        return new ApiSuccessResponse(
            $formatedData,
            ['message' => 'Performer Movie data Show'],
            200
        );
    }

    /**
     * singleMovie function
     *
     * @param Movie $movie
     * @return ApiSuccessResponse
     */
    public function singleMovie(Movie $movie): ApiSuccessResponse
    {
        $data = new MovieResource($movie);

        return new ApiSuccessResponse(
            $data,
            ['message' => 'Single Movie data Show'],
            200
        );
    }

    /**
     * store function
     *
     * @param MovieRequest $request
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function store(MovieRequest $request): ApiErrorResponse|ApiSuccessResponse
    {
        try {
            $data = $this->movieService->store($request);

            return new ApiSuccessResponse(
                $data,
                ['message' => 'Movie Store Successfully'],
            );
        } catch (\Exception $e) {
            Log::error($e);

            return new ApiErrorResponse(
                new Exception(),
                "Error updating Movie",
                Response::HTTP_NOT_FOUND,
            );
        }
    }

    /**
     * update function
     *
     * @param Movie $movie
     * @param Request $request
     * @return ApiSuccessResponse
     */
    public function update(Movie $movie, Request $request): ApiSuccessResponse
    {
        $data = $this->movieService->update($movie, $request);

        return new ApiSuccessResponse(
            $data,
            ['message' => 'Movie Update Successfully'],
        );
    }

    /**
     * giveRating function
     *
     * @param Movie $movie
     * @param Request $request
     * @return ApiSuccessResponse
     */
    public function giveRating(Movie $movie, Request $request): ApiSuccessResponse
    {
        $data = $this->movieService->giveRating($movie, $request);

        return new ApiSuccessResponse(
            $data,
            ['message' => 'Movie Update Rating Successfully'],
        );
    }

    /**
     * delete function
     *
     * @param Movie $movie
     * @return ApiSuccessResponse
     */
    public function delete(Movie $movie): ApiSuccessResponse
    {
        $data = $this->movieService->delete($movie);

        return new ApiSuccessResponse(
            $data,
            ['message' => 'Movie Delete Successfully'],
        );
    }

    /**
     * rating function
     *
     * @param Movie $movie
     * @param Request $request
     * @return ApiSuccessResponse
     */
    public function rating(Movie $movie, Request $request): ApiSuccessResponse
    {
        $data = $this->movieService->rating($movie, $request);

        return new ApiSuccessResponse(
            $data,
            ['message' => 'Movie Rating Update Successfully'],
        );
    }
}
