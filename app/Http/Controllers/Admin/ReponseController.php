<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReponseController extends Controller
{

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

        // Envoie mail à l'utilisateur commentaire supprimer
        Mail::send('mail.reponse_deleted', compact('reponse'), function($message) use ($reponse){

            $message->to($reponse->users->email, '')->subject(Lang::get('general.suscribe_mail_title'));
        });

    }

}
