<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RubriqueRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RubriqueController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* Recherche */
        $rubrique = \App\Rubrique::
        where('nom', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $rubrique->setPath('rubrique');

        if(count($rubrique) == 0){
            $message = "Aucune rubrique !";
            $info = \App\Rubrique::orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info,
                    'message' => $message
                ]);
            }
        }else{
            $info = \App\Rubrique::orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info
                ]);
            }
        }


        return view('admin.rubrique.index', compact('rubrique'))->render();
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $rubrique = \App\Rubrique::
        where('nom', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $rubrique->setPath('rubrique');

        if(count($rubrique) == 0){
            $message = "Aucune rubrique !";
            $info = \App\Rubrique::orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info,
                    'message' => $message
                ]);
            }
        }else{
            $info = \App\Rubrique::orderBy('created_at', 'desc')->get();
            if($request->ajax()){
                return response()->json([
                    'info'     => $info
                ]);
            }
        }
        // FIN


        return view('admin.rubrique.index', compact('rubrique'))->render();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('admin.rubrique.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RubriqueRequest $request)
    {
        $rubrique = new \App\Rubrique;

        $rubrique->nom = $request->nom;
        $rubrique->description = $request->description;
        $rubrique->statut = 'Actif';
        $rubrique->save();

        // Récupération de l'insertion précedente
        //$last_users = \App\Users::orderBy('id', 'desc')->limit(1)->get();
        $last_users = $rubrique->id;

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $last_users;
        $noti->title = 'Une Rubrique à été créer, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('rubrique')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($rubrique)
    {
        return view('admin.rubrique.index', compact('rubrique'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($rubrique, Request $request)
    {
        return view('admin.rubrique.edit', compact('rubrique'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($rubrique, RubriqueRequest $request)
    {
        $rubrique->nom = $request->nom;
        $rubrique->description = $request->description;
        $rubrique->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $rubrique->id;
        $noti->title = 'Une rubrique à été modifié, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('rubrique')->withFlashMessage("Mise à jours effectué avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($rubrique, Request $request)
    {
        $rubrique->statut = 2;
        $rubrique->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $rubrique->id;
        $noti->title = 'Une rubrique à été rendu inactif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\Rubrique::where('statut', '=', 'Archivé')->where('id', '=', $rubrique->id)->get();
        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $rubrique->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('rubrique');
    }


    /**
     * @param $users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function actif($rubrique, Request $request){
        $rubrique->statut = 1;
        $rubrique->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $rubrique->id;
        $noti->title = 'Une rubrique à été rendu actif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();



        $info = \App\Rubrique::where('statut', '=', 'Actif')->where('id', '=', $rubrique->id)->get();
        $message = "Element visible à présent";
        if($request->ajax()){
            return response()->json([
                'id'        => $rubrique->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('rubrique');
    }



}