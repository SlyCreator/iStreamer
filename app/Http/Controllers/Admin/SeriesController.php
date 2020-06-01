<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\SeriesCollection;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series =   Series::all();
        return new SeriesCollection($series);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $series =   Series::create([
            'title' => $request->input('data.attributes.title'),
        'description' => $request->input('data.attributes.description'),
        'year' =>  $request->input('data.attributes.year'),
        ]);

        return (new SeriesResource($series))
            ->response()
            ->header('Location',route('series.show',[
                'series' => $series,
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        return new SeriesResource($series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series)
    {
        $series->update($request->input('data.attributes'));
        return new SeriesResource($series);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function delete(Series $series)
    {
        $series->delete();
        return response(null,204);
    }
}
