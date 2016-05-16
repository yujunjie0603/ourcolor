<?php

use Illuminate\Database\Seeder;
use App\Colors;

class ColorsTableSeeder extends Seeder {

  public function run()
  {
    DB::table('colors')->delete();

    Colors::create([
      'name'   => 'red',
      'color_code'    => '#ff0000',
    ]);
    Colors::create([
      'name'   => 'white',
      'color_code'    => '#ffffff',
    ]);
    Colors::create([
      'name'   => 'black',
      'color_code'    => '#000000',
    ]);
    Colors::create([
      'name'   => 'yellow',
      'color_code'    => '#00ff00',
    ]);
    Colors::create([
      'name'   => 'bleu',
      'color_code'    => '#0000ff',
    ]);
  }
}