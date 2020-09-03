<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'user_id',
        'description',
        'read'
    ];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function scopeGetAllLogs($query){
        return Log::where('read',0)->orderBy('id','DESC')->get();
    }

    public function scopeNoRead($query){
        return Log::where('read',0)->get();
    }

    public function scopeCreateNewLog($query,$type,$user_id,$description){
        return $this->create([
            'type'        => $type,
            'user_id'     => $user_id,
            'description' => $description
        ]);
    }

    public function scopeInactiveLog($query, $id){
        return $query->find($id)->update([
            'read' => 1
        ]);
    }

    public function scopeInactiveAllLog($query){
        return $query->update([
            'read' => 1
        ]);
    }
}
