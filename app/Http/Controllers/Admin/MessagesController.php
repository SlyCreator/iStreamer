<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       // $messages    =   Message::with('series')->get()->all();
        $messages   =   Message::all();
        return new MessageCollection($messages);
        //return response()->json(['data'=>$messages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        dd($request->all());
        $path = $request->file('images')->store('images','s3');
        dd($path);
        $message = Message::create([
            'title' =>  $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'series_id' => $request->input('data.attributes.series_id'),
        ]);
        return new MessageResource($message);
    }


    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return MessageResource
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Message $message
     * @return MessageResource
     */
    public function update(Request $request, Message $message)
    {
        $message->update($request->input('data.attributes'));
        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return Response
     * @throws \Exception
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return response(null,204);
    }
}
