<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Teams;
use App\LogMail;
use App\Colors;
use App\ColorInfo;
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


    public function informer($id)
    {
        $user = User::find($id);
        $log_mail = LogMail::where('id_client', $id)->get();
        $msg = "Bonjour " . $user['name'] . " : \r\n";

        if (date('N') == '6' || date('N') == '7' ) {
            $colorInfo = ColorInfo::where('team_id', $user['team_id'])
                ->where('date', '>=', date('Y-m-d', strtotime('+1 day')))
                ->where('date', '<=', date('Y-m-d', strtotime('+5 day')))
                ->get();
        } else {
            $colorInfo = ColorInfo::where('team_id', $user['team_id'])
                ->where('date', date('Y-m-d', strtotime('+1 day')))
                ->get();  
        }
        
        if ($colorInfo) {
            $color = Colors::find($colorInfo[0]['color_id']);
            $msg .= "La couleur de demain(" . date('Y-m-d', strtotime('+1 day')) . ") est : " . $color['name'] . "\r\n";
            if (count($colorInfo) > 1) {

                $msg .= "Les couleur de la semaine prochaine sont :\r\n";
                foreach ($colorInfo as $value) {
                    $msg .= "le " . $value['date'] . " est " . $value->hasOneColor['name'] . "\r\n";
                }
            }
            if (mail($user->email, 'Couleur Equipe ', $msg)) {
                echo "ok";
            } else {
                echo "error";
            }
        }
    }    
}
