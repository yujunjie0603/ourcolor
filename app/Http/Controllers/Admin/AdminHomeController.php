<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ColorInfo;
use App\Colors;
class AdminHomeController extends Controller
{
    public function index() 
    {
    	$data = array('listeColorInfo' => ColorInfo::orderby('team_id')->orderby('date')->get(),
    		'listeColor' => Colors::all()
    		);
    	return view('admin.index', $data);
    }
}
