<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SujetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* Recherche */
        $sujet = \App\QuestionForum::with('rubrique', 'users')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $sujet->setPath('sujet');

        if(count($sujet)==0){
            $message = "Aucun Sujet !";
            $info = \App\QuestionForum::with('rubrique', 'users')->orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info,
                    'message' => $message
                ]);
            }
        }else{
            $info = \App\QuestionForum::with('rubrique', 'users')->orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info
                ]);
            }
        }

        return view('admin.sujet.index', compact('sujet'))->render();
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $sujet = \App\QuestionForum::with('rubrique', 'users')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $sujet->setPath('sujet');

        if(count($sujet)==0){
            $message = "Aucun Sujet !";
            $info = \App\QuestionForum::with('rubrique', 'users')->orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info,
                    'message' => $message
                ]);
            }
        }else{
            $info = \App\QuestionForum::with('rubrique', 'users')->orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info
                ]);
            }
        }
        // FIN


        return view('admin.sujet.index', compact('sujet'))->render();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($sujet)
    {
        $reponse = \App\QuestionReponse::with('questionForum', 'users')->where('id_question_forum', '=', $sujet->id)->orderBy('created_at', 'desc')->get();
        return view('admin.sujet.show', compact('sujet', 'reponse'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($sujet, Request $request)
    {
        $sujet->statut = 2;
        $sujet->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $sujet->id;
        $noti->title = 'Un sujet à été rendu inactif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\QuestionForum::where('statut', '=', 'Archivé')->where('id', '=', $sujet->id)->get();
        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $sujet->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);

        // Envoie mail à l'utilisateur commentaire supprimer
        Mail::send('mail.sujetDelete', compact('sujet'), function($message) use ($sujet){

            $message->to($sujet->users->email, '')->subject(Lang::get('general.suscribe_mail_title'));
        });


        return redirect()->route('sujet');
    }


    /**
     * @param $users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function actif($sujet, Request $request){
        $sujet->statut = 1;
        $sujet->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $sujet->id;
        $noti->title = 'Un sujet à été rendu actif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\QuestionForum::where('statut', '=', 'Actif')->where('id', '=', $sujet->id)->get();
        $message = "Element visible à présent";
        if($request->ajax()){
            return response()->json([
                'id'        => $sujet->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);

        // Envoie mail à l'utilisateur commentaire supprimer
        Mail::send('mail.sujetActif', compact('sujet'), function($message) use ($sujet){

            $message->to($sujet->users->email, '')->subject(Lang::get('general.suscribe_mail_title'));
        });


        return redirect()->route('sujet');
    }



}
