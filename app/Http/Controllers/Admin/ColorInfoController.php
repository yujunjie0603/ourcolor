<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ColorInfo;
use App\Teams;
use App\Colors;
use Redirect, Input, Auth;

class ColorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.colorinfo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Teams::all();
        $colors = Colors::all();
        return view('admin.colorinfo.create', 
            ['teams' => $teams, 'colors' => $colors]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'team' => 'required',
            'date' => 'required'
            ]);
        $date = $request->input('date');
        $team = $request->input('team');
        $name = $request->input('name');
        $newColor = $request->input('new_color');
        $colorId = $request->input('color');
        $checkColorError = false;
        if (!$colorId && !$newColor) {
            $checkColorError = true;
        }

        $checkColorInfo = ColorInfo::where('date', $date)->where('team_id', $team)->count();
        if ($checkColorInfo || $checkColorError) {

            if ($checkColorError) {
                $errorInfo = "aaaaaaaaaaa";
            } else {
                $errorInfo = "bbbbbbbbbbb";
            }
            return redirect()->back()->withErrors($errorInfo)->withInput();
        } else {

            if ($colorId === '' && $newColor != '') {
                $color = new Colors;
                if ($name == '') {
                    $name = $newColor;
                }
                $color->name = $name;
                $color->color_code = $newColor;
                $color->save();
                $colorId = $color->id;
            }
            $colorInfo = new ColorInfo;
            $colorInfo->date = $date;
            $colorInfo->team_id = $team;
            $colorInfo->color_id = $colorId;
            if ($colorInfo->save()) {
                //return redirect('admin/');
            }
            return redirect()->back()->withErrors("Erreur de la création !")->withInput();
        }
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

        $colorInfo = ColorInfo::find($id);
        $colorInfo->color_id = \Illuminate\Support\Facades\Input::get('couleur');
        if ($colorInfo->save()) {
            $return = array(
                'id' => $id,
                'color_code' => $colorInfo->hasOneColor->color_code,
                'name' => $colorInfo->hasOneColor->name
                );
            return json_encode($return);
        } else {
            return "echoue";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($colorInfo = ColorInfo::destroy($id)) {
            return "reussi";
        } else {
            return "echoue";
        }
    }
}
