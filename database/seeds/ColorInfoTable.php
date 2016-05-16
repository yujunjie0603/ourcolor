<?php

use Illuminate\Database\Seeder;
use App\ColorInfo;

class ColorInfoTableSeeder extends Seeder {

  public function run()
  {
    DB::table('color_info')->delete();

    for ($i=0; $i < 5; $i++) {
      ColorInfo::create([
        'color_id'   => $i,
        'date'    => '2016-05-13',
        'team_id'    => 1,
      ]);
    }
  }

}