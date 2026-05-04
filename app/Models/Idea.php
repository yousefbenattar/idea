<?php

namespace App\Models;

use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $casts =[
        'links' => AsArrayObject::class,
        'status' => IdeaStatus::class
    ];
    protected $attributes = [
        'status' => IdeaStatus::PENDING->value,
    ];
    public function user ()
    {
      return $this->belongsTo(User::class);
    }
    public function steps ()
    {
      return $this->hasMany(Step::class);
    }

}
