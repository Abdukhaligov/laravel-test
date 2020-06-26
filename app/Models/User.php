<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {
  use Notifiable;

  protected $fillable = [
      'name', 'email', 'password',
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function company(){
    return $this->belongsTo(Company::class);
  }

  public function position(){
    return $this->belongsTo(Position::class);
  }

  public function isAdmin() {
    return DB::select("CALL is_user_admin($this->id)")[0]->admin;
  }
}
