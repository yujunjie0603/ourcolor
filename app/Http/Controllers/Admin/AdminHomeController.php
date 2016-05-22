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
    	$calendar = Calendar::draw_calendar(5,2016);

    	$data = array('listeColorInfo' => ColorInfo::where('team_id', $team_id)->orderby('team_id')->orderby('date')->get(),
    		'listeColor' => Colors::all(),
    		'teamId' => $team_id,
    		'listeTeam' => Teams::all(),
    		'calendar' => $calendar
    		);
    	return view('admin.index', $data);
    }
}
