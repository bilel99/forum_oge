<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReponseController extends Controller
{
	public function index($id){
		$question_reponse = \App\QuestionReponse::with('questionForum')->where('id_question_forum', '=', $id)->get();
		return view('front.reponse.index', compact('question_reponse'));
	}
}