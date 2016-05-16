<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Colors;

class ColorInfo extends Model
{
    public $table = 'color_info';
    public $timestamps = true;

    public function hasOneColor()
    {
    	return $this->hasOne('App\Colors', 'id', 'color_id');
    }
}
