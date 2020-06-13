<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
{
    private $updated_at;

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
                'thumbnail' => $this->thumbnail,
                'thumbnail_url' => $this->thumbnail_url,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
                ]
        ];
    }
}
