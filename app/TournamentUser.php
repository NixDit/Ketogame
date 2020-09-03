<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentUser extends Model
{
    protected $table = 'tournament_user';

    protected $fillable = [
        'tournament_id',
        'user_id',
        'picture_1',
        'picture_2',
        'picture_3',
        'picture_4',
        'picture_5'
    ];
}
