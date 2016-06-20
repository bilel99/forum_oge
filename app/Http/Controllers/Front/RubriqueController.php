<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RubriqueController extends Controller
{
	public function index($id){
		$rubrique = \App\Rubrique::where('statut', '=', 'Actif')->get();
		$rubriqueId = \App\Rubrique::where('id', '=', $id, 'AND','statut', '=', 'Actif')->get();
		$question_forum = \App\QuestionForum::with('rubrique', 'users')->where('id_rubrique', '=', $id, 'AND', 'statut', '=', 'Actif')->get();
		return view('front.rubrique.index', compact('rubrique', 'question_forum', 'rubriqueId'));
	}
}