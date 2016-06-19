<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontUsersRequest;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sujet = \App\QuestionForum::with('rubrique', 'users')->where('id_users', '=', Auth::user()->id)->get();
        $reponse = \App\QuestionReponse::with('questionForum', 'users')->where('id_users', '=', Auth::user()->id)->get();

        return view('front.compte.index', compact('sujet', 'reponse'));
    }


    public function update($users, FrontUsersRequest $request){
        $password = $request->password;

        $users->nom = $request->nom;
        $users->prenom = $request->prenom;
        $users->email = $request->email;
        $users->password = \Hash::make($password.\Config::get('constante.salt'));
        $users->password = $request->password;
        $users->telephone = $request->telephone;
        $users->save();

        return redirect(route('compte/index'))->withFlashMessage("Mise à jours effectué avec succès");
    }




}