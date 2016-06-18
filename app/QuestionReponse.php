<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionReponse extends Model
{
    protected $table = 'question_reponse';
    protected $fillable = ['id_question_forum', 'id_users', 'description'];


    public function questionForum(){
        return $this->belongsTo('\App\QuestionForum', 'id_question_forum');
    }

    public function users(){
    	return $this->belongsTo('\App\Users', 'id_users');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}