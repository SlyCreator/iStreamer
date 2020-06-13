<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['title','description','audio_name','audio_url','series_id'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
