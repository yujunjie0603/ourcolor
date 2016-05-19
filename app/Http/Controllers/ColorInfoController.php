<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ColorInfo;
use App\Colors;
use App\Teams;
class ColorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($team = "")
    {

        $data = array('listeTeam' => Teams::all());
        if (!$team) {
            $team = 1;
        }

        $day = date('N');
        $datebegin1 = date('Y-m-d', strtotime('-' .($day - 1). 'days'));
        $datefin1 = date('Y-m-d', strtotime('+' .(6-$day). 'days'));
        $datebegin2 = date('Y-m-d', strtotime('+' . (7 - $day) . 'days'));
        $datefin2 = date('Y-m-d', strtotime('+' .(13-$day). 'days'));

        $data['colorInfos1'] = ColorInfo::where('team_id', $team)->where('date', '>=', $datebegin1)->where('date', '<', $datefin1)->get();
        $data['colorInfos2'] = ColorInfo::where('team_id', $team)->where('date', '>=', $datebegin2)->where('date', '<', $datefin2)->get();
        return view('colorinfo.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
