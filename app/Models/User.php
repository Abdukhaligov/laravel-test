<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia {
  use Notifiable;
  use InteractsWithMedia;

  protected $fillable = [
      'name', 'email', 'password', 'company_id', 'position_id'
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function registerMediaCollections(): void {
    $this
        ->addMediaCollection('user_media')
        ->useDisk('media');
  }

  public function company() {
    return $this->belongsTo(Company::class);
  }

  public function position() {
    return $this->belongsTo(Position::class);
  }

  public function isAdmin() {
    return DB::select("CALL is_user_admin($this->id)")[0]->admin;
  }
}
