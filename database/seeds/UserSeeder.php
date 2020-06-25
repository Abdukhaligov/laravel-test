<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder {
  public function run() {
    $users = [
        ["name" => "admin", "email" => "admin@site.com", "password" => bcrypt(123456), "admin" => true],
    ];

    DB::table('users')->insert($users);
  }
}
