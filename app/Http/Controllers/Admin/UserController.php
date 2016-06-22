<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Teams;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.user.index')->with(array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Teams::all();
        return view('admin.user.create', 
            ['teams' => $teams]
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
            'nom' => 'required',
            'email' => 'required|unique:users,email|email',
            'team' => 'required',
            'telephone' => 'required'
            ]);

        $user = User::create([
            'name' => $request->input('nom'),
            'email' => $request->input('email'),
            'password' => bcrypt("axialys2016"),
            'team_id' => $request->input('team'),
            'telephone' => $request->input('telephone')
        ]);
        if ($user) {
            return redirect('admin/user');
        }
        return redirect()->back()->withErrors('Erreur de la création de user')->withInput();
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
        $user = User::find($id);
        $teams = Teams::all();
        return view('admin.user.edit', 
            ['teams' => $teams, 'user' => $user]
        );
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
        $user = User::find($id);
        if ($user) {
            $this->validate($request, [
                'nom' => 'required',
                'email' => 'required|unique:users,email,' . $id . '|email',
                'team' => 'required',
                'telephone' => 'required'
                ]);
            $user->name = $request->input('nom');
            $user->email = $request->input('email');
            $user->team_id = $request->input('team');
            $user->telephone = $request->input('telephone');
            if ($user->save()) {
                return redirect('admin/user');
            }
        }
        return redirect()->back()->withErrors("Erreur de la mis à jour !")->withInput();
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
