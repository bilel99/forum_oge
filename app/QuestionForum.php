<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionForum extends Model
{
    protected $table = 'question_forum';
    protected $fillable = ['id_rubrique', 'id_users', 'nom', 'description', 'statut', 'valider'];


    public function rubrique(){
        return $this->belongsTo('\App\Rubrique', 'id_rubrique');
    }

    public function users(){
    	return $this->belongsTo('\App\Users', 'id_users');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}