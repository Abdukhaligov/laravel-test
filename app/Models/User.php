<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements HasMedia {
  use Notifiable, HasApiTokens, InteractsWithMedia;

  protected $fillable = [
      'name', 'email', 'password', 'company_id', 'position_id'
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function toArray() {
    $array = parent::toArray();
    $array['company'] = $this->company ? $this->company->name : '' ;
    $array['position'] = $this->position ? $this->position->name : '';
    unset($array['email_verified_at']);
    unset($array['admin']);
    return $array;
  }

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

  public function roles(){
    return DB::select("CALL get_user_roles($this->id)");
  }

  public function isAdmin() {
    return in_array((object) ["name" => "Administrator"], $this->roles());
  }
}
