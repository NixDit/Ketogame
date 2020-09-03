<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Tournament extends Model
{
    use SoftDeletes;

    protected $table = 'tournaments';
    protected $dates = [
        'deleted_at',
        'start_date'
    ];
    protected $fillable = [
        'name',
        'description',
        'prize_pool',
        'max_participants',
        'start_date',
        'champion',
        'total_participants',
        'active',
        'champion_id'
    ];

    public function players(){
        return $this->belongsToMany('App\User')->withPivot(['picture_1','picture_2','picture_3','picture_4','picture_5']);
    }

    public function champion(){
        return $this->belongsTo('App\User');
    }

    public function scopeGetAllTournaments($query){
        return $this->orderBy('id', 'DESC')->get();
    }

    public function scopeCreateTournament($query,$data){
        return $query->create([
            'name'             => $data->name,
            'description'      => $data->description,
            'prize_pool'       => $data->prize_pool,
            'max_participants' => $data->max_participants,
            'start_date'       => new Carbon(str_replace('/','-',$data->start_date))
        ]);
    }

    public function scopeGetTournament($query,$id){
        return $query->find($id);
    }

    public function scopeUpdateTournament($query,$data){
        return $query->find($data->id)->update([
            'name'             => $data->name,
            'description'      => $data->description,
            'prize_pool'       => $data->prize_pool,
            'max_participants' => $data->max_participants,
            'start_date'       => new Carbon(str_replace('/','-',$data->start_date))
        ]);
    }

    public function scopeCloseTournament($query, $id){
        return $query->find($id)->update([
            'active' => 2
        ]);
    }

    public function scopeDeleteTournament($query,$id){
        return $query->find($id)->delete();
    }

    public function scopeChangeStatusTournament($query,$data){
        return $query->find($data->id)->update([
            'active' => $data->status
        ]);
    }

    public function scopeSetChampion($query,$data){
        return $query->find($data->id)->update([
            'champion_id' => $data->player
        ]);
    }
}
