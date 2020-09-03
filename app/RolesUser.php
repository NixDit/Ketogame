<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'name'
    ];
}
