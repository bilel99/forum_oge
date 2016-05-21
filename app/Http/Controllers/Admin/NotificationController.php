<?php

namespace App\Http\Controllers\Admin;

use App\Actu;
use App\Http\Requests\ActuRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notif = \App\NotificationHistory::with('users')->where('status', '=', 1)->orderBy('id', 'desc')->paginate(8);
        $notif->setPath('notifications');


        $message = "Aucun élément présent actuellement !";
        $notificationAjax = \App\NotificationHistory::with('users')->get();
        if($request->ajax()){
            return response()->json([
                'info'      =>  $notificationAjax,
                'message'   =>  $message
            ]);
        }


        return view('admin.notification.index', compact('notif'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($notification)
    {
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function deleteAll(Request $request){
        $noti = \App\NotificationHistory::get();
        foreach($noti as $n){
            $n->delete();
        }

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif;
        $noti->title = 'Un historique de notification à été supprimé';
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'message'   => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->route('notifications');
    }
}
