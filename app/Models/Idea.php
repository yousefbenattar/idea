<?php

namespace App\Models;

use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idea extends Model
{
  use HasFactory;
  protected $casts = [
    'links' => AsArrayObject::class,
    'status' => IdeaStatus::class
  ];
  protected $attributes = [
    'status' => IdeaStatus::PENDING->value,
  ];
  public static function statusCount(User $user)
  {
    $counts = $user->ideas()
      ->selectRaw('status, count(*) as count')
      ->groupBy('status')
      ->pluck('count', 'status');

    return collect(IdeaStatus::cases())
      ->mapWithKeys(fn($status) => [
        $status->value => $counts->get($status->value, 0),
      ])
      ->put('all', $user->ideas()->count());
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function steps()
  {
    return $this->hasMany(Step::class);
  }

}
