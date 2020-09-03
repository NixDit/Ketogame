<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpicAccount extends Model
{
	protected $table = 'epic_accounts';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'solo_victory',
        'solo_matches',
        'solo_kills',
        'duo_victory',
        'duo_matches',
        'duo_kills',
        'squad_victory',
        'squad_matches',
        'squad_kills'
    ];

    public function user()
    {
        return $this->hasOne('App\User','user_id','id');// (modelo, columna de la tabla actual, columna a referenciar)
    }

    public function scopeEpicRegistered($query, $id){
        return $query->where('user_id', $id)->get()->count();
    }

    public function scopeRegisterEpicStats($query, $data){
        $query->create($data->all());
    }

    public function scopeUpdateEpicStats($query, $data){
        $query->update($data->all());
    }
}
