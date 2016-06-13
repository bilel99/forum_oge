<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Rubrique extends Model
{
    protected $table = 'rubrique';
    protected $fillable = ['nom', 'description', 'statut'];

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
