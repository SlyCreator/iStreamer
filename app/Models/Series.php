<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = ['title','description','year'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
