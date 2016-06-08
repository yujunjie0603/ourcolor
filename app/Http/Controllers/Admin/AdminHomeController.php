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
    public function index(Request $request, $team_id = "") 
    {
    	if ($team_id == "") {
    		$team_id = 1; // equipe developpement
    	}
        $month = ($request->input('month'));
        $year = ($request->input('year'));
        $listeColorTeam = ColorInfo::where('team_id', $team_id)->orderby('team_id')->orderby('date')->get();
        $listeColor = Colors::all();
        $data = array('listeColorInfo' => $listeColorTeam,
            'listeColor' => $listeColor,
            'teamId' => $team_id,
            'listeTeam' => Teams::all()
            );
        foreach ($listeColorTeam as $key => $value) {
            $color[$value->date] = array('id' => $value->id, 'color' => $value->hasOneColor->color_code);
        }
        $month = isset($month) && $month ? $month : date('m');
        $year = isset($year) && $year ? $year : date('Y');
        $calendar = Calendar::draw_calendar($month, $year, $color);
        $data['calendar'] = $calendar;
    	return view('admin.index', $data);
    }
}
