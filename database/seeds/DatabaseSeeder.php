<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
  public function run() {
    $this->call(UserSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(CompanySeeder::class);
    $this->call(PositionSeeder::class);
  }
}
