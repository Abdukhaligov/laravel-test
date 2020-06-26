<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
  public function run() {
    $this->call(UserSeeder::class);

    factory(\App\Models\Company::class,10)->create();
    factory(\App\Models\Position::class,5)->create();

    $company_positions = [];
    for ($i=1;$i<=10;$i++){
      for ($j=0;$j<=2;$j++){
        $company_positions [] =
            ["company_id" => $i, "position_id" => rand(1,3) + $j];
      }
    }

    DB::table('company_positions')->insert($company_positions);

  }
}
