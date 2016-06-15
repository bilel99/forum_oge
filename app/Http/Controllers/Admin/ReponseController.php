<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReponseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        /* Recherche */
        $reponse = \App\QuestionReponse::with('questionForum', 'users')
            ->where('id_question_forum', '=', $id)
            ->where('description', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $reponse->setPath('reponse');

        $message = 'Liste des reponses';
        $info = \App\QuestionReponse::with('questionForum', 'users')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info,
                'message'   => $message
            ]);
        }

        return view('admin.sujet.reponse', compact('reponse'))->render();
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search($id, Request $request){

        /* Recherche */
        $reponse = \App\QuestionReponse::with('questionForum', 'users')
            ->where('id_question_forum', '=', $id)
            ->where('description', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $reponse->setPath('reponse');

        $message = 'Liste des reponses';
        $info = \App\QuestionReponse::with('questionForum', 'users')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info,
                'message'   => $message
            ]);
        }
        // FIN


        return view('admin.sujet.reponse', compact('reponse'))->render();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($reponse)
    {
        return view('admin.sujet.show', compact('reponse'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($reponse, Request $request)
    {
        $reponse->delete();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $reponse->id;
        $noti->title = 'Une réponse à été supprimé, '.$request->id;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\QuestionReponse::where('id', '=', $reponse->id)->get();
        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $reponse->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('reponse');
    }

}
