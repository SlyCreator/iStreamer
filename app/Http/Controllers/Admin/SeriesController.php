<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\SeriesCollection;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use INlluminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SeriesCollection
     */
    public function index()
    {
        $series =   Series::all();
        return new SeriesCollection($series);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SeriesResource
     */
    public function create(Request $request)
    {
        $data['attributes'] = $request->all();
        $path = $request->file('thumbnail')->store('images','s3');
        $series =   Series::create([
            'title' => $data['attributes']['title'],
            'description' => $data['attributes']['description'],
            'year' =>  $data['attributes']['year'],
            'thumbnail'=>basename($path),
            'thumbnail_url' =>Storage::disk('s3')
        ]);
            return new SeriesResource($series);
    }

    /**
     * Display the specified resource.
     *
     * @param Series $series
     * @return SeriesResource
     */
    public function show(Series $series)
    {
        return new SeriesResource($series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Series $series
     * @return SeriesResource
     */
    public function update(Request $request, Series $series)
    {
        $series->update($request->input('data.attributes'));
        return new SeriesResource($series);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Series $series
     * @return Response
     * @throws Exception
     */
    public function delete(Series $series)
    {
        $series->delete();
        return response(null,204);
    }
}
