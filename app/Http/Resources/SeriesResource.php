<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => (string)$this->id,
            "type" => 'series',
            "attributes" => [
                'title' => $this->title,
                'description' => $this->description ,
                'year' =>  $this->year,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
                ]
        ];
    }
}
