<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ColorInfo;
use App\Colors;
use App\Teams;
use App\lib\Calendar;

class AdminHomeController extends Controller
{
    public function index($team_id = "") 
    {
    	if ($team_id == "") {
    		$team_id = 1; // equipe developpement
    	}
        $listeColorTeam = ColorInfo::where('team_id', $team_id)->orderby('team_id')->orderby('date')->get();
        $listeColor = Colors::all();
        $data = array('listeColorInfo' => $listeColorTeam,
            'listeColor' => $listeColor,
            'teamId' => $team_id,
            'listeTeam' => Teams::all()
            );
        foreach ($listeColorTeam as $key => $value) {
            $color[$value->date] = $value->hasOneColor->color_code;
        }

        $calendar = Calendar::draw_calendar(5, 2016, $color);
        $data['calendar'] = $calendar;
    	return view('admin.index', $data);
    }
}
