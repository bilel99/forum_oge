<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RubriqueController extends Controller
{
	public function index($id){
		$rubrique = \App\Rubrique::get();
		$question_forum = \App\QuestionForum::where('id_rubrique', '=', $id)->get();
		return view('front.rubrique.index', compact('rubrique', 'question_forum'));	
	}
}