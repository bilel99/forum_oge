<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ReponseRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReponseController extends Controller
{
	/**
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index($id){
		$sujet = \App\QuestionForum::with('rubrique', 'users')->where('id', '=', $id)->get();
		$question_reponse = \App\QuestionReponse::with('questionForum', 'users')->where('id_question_forum', '=', $id)->get();

		return view('front.reponse.index', compact('sujet', 'question_reponse'));
	}


	/**
	 * @param QuestionRequest $request
	 * @return mixed
	 */
	public function store(ReponseRequest $request)
	{
		$reponse = new \App\QuestionReponse;
		$reponse->id_question_forum = $request->id_question_forum;
		$reponse->id_users = Auth::user()->id;
		$reponse->description = $request->reponse;
		$reponse->save();

		return redirect()->back()->withFlashMessage("Création effectué avec succès");
	}



	/**
	 * @param $id
	 */
	public function destroy($id, Request $request){
		//$reponse = \App\QuestionReponse::with('questionForum', 'users')->get();
		$reponse = \App\QuestionReponse::where('id', '=', $id)->get();
		$reponse->delete();

		$info = \App\QuestionReponse::where('id', '=', $id)->get();
		$message = "suppression effectué avec succès";
		if($request->ajax()){
			return response()->json([
				'id'        => $id,
				'message'   => $message,
				'info'     => $info
			]);
		}
		Session::flash('message', $message);

	}



	public function updateSujet($sujet, Request $request){
		//$sujet = \App\QuestionForum::where('id', '=', $id)->get();
		$sujet->valider = 1;
		$sujet->save();

		$info = \App\QuestionForum::where('id', '=', $sujet->id)->get();
		$message = "Sujet valide";
		if($request->ajax()){
			return response()->json([
				'id'        => $sujet->id,
				'message'   => $message,
				'info'     => $info
			]);
		}
		Session::flash('message', $message);
	}

}