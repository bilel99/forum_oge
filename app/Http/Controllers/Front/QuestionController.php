<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(){
        $rubriques = \App\Rubrique::lists('nom', 'id');
		return view('front.question.index', compact('rubriques', 'question_forum'));
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(QuestionRequest $request)
    {
        $question = new \App\QuestionForum;
        $question->create($request->all());

        return redirect('')->withFlashMessage("");
    } 

}