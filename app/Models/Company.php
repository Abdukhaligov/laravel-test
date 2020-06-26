<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
  public function companies(){
    return $this->belongsToMany(Position::class);
  }
}
