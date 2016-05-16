<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ColorInfo;
class AdminHomeController extends Controller
{
    public function index() 
    {
    	$data = ColorInfo::orderby('team_id')->orderby('date')->get();
    	return view('admin.index', array('listeColorInfo' => $data));
    }
}
