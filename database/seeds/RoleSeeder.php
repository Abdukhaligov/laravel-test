<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
  public function run() {
    (new App\Models\Role(['name'=>'Administrator']))->save();
    (new App\Models\Role(['name'=>'Moderator']))->save();
    (new App\Models\Role(['name'=>'Guest']))->save();

    DB::table('user_role')->insert(["user_id" => 1, "role_id" => 1]);
  }
}
