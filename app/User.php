<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\EpicAccount;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'epic_id',
        'profile_picture',
        'country_id',
        'mobile',
        'dark_mode'
    ];
    protected $with = ['epic','roles'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tournaments(){
        return $this->belongsToMany('App\Tournament')->withPivot(['picture_1','picture_2','picture_3','picture_4','picture_5']);
        // return $this->belongsToMany('App\Tournament');
    }

    public function epic(){
        return $this->belongsTo('App\EpicAccount','id','user_id');// (modelo, columna de la tabla actual, columna a referenciar)
    }

    public function championships(){
        return $this->hasMany('App\Tournament', 'champion_id', 'id');
    }

    public function logs(){
        return $this->hasMany('App\Log');
    }

    public function country(){
        return $this->belongsTo('App\Country', 'country_id' , 'id'); // Same as WHERE User.Country_id = Country.id
    }

    public function scopeSetDarkMode($query,$request){
        $userUpdate = $query->find($request->id)->update(['dark_mode' => $request->mode]);
        return $userUpdate;
    }

    public function scopeGetAllUsers($query){
        return $this->orderBy('id', 'DESC')->with('logs')->get();
    }

    public function scopeGetAllUsersWithTrashed($query){
        return $this->orderBy('id', 'DESC')->withTrashed()->with('logs')->get();
    }

    public function scopeGetUser($query, $id){
        return $query->with('logs')->find($id);
    }

    public function scopeCreateNewUser($query,$request, $image){
        $user = $this->create([
            'name'            => ucwords(strtolower($request->name)),
            'lastname'        => ucwords(strtolower($request->lastname)),
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'profile_picture' => $image,
            'country_id'      => $request->country_id,
            'mobile'          => str_replace('-','',$request->mobile)
        ]);
        EpicAccount::create([
            'user_id' => $user->id,
            'name'    => $request->epic_id
        ]);
        $user->assignRole('guest');
        return $user;
    }

    public function scopeCreateNewAdmin($query,$request, $image, $role){
        $user = $this->create([
            'name'            => ucwords(strtolower($request->name)),
            'lastname'        => ucwords(strtolower($request->lastname)),
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'profile_picture' => $image,
            'country_id'      => $request->country_id,
            'mobile'          => str_replace('-','',$request->mobile)
        ]);
        EpicAccount::create([
            'user_id' => $user->id,
            'name'    => $request->epic_id
        ]);
        $user->assignRole($role);
        return $user;
    }

    public function scopeUpdateUser($query,$request,$image){
        $userExist = $query->find($request->id);
        $user      = $query->find($request->id)->update([
            'name'            => ucwords(strtolower($request->name)),
            'lastname'        => ucwords(strtolower($request->lastname)),
            'email'           => $request->email,
            'profile_picture' => $image,
            'country_id'      => $request->country_id,
            'mobile'          => str_replace('-','',$request->mobile)
        ]);
        if($request->password != null){
            $userExist->update(['password' => Hash::make($request->password)]);
        }
        if($user){
            if(is_null($userExist->epic)){
                EpicAccount::create([
                    'user_id' => $request->id,
                    'name'    => $request->epic_id
                ]);
            } else {
                EpicAccount::where('user_id', $request->id)->update([
                    'name' => $request->epic_id
                ]);
            }
        }
        return $user;
    }

    public function scopeUpdateAdmin($query,$request,$image,$role){
        // dd($role);
        $userExist = $query->find($request->id);
        $user      = $query->find($request->id)->update([
            'name'            => ucwords(strtolower($request->name)),
            'lastname'        => ucwords(strtolower($request->lastname)),
            'email'           => $request->email,
            'profile_picture' => $image,
            'country_id'      => $request->country_id,
            'mobile'          => str_replace('-','',$request->mobile)
        ]);
        if($request->password != null){
            $userExist->update(['password' => Hash::make($request->password)]);
        }
        if($user){
            if(is_null($userExist->epic)){
                EpicAccount::create([
                    'user_id' => $request->id,
                    'name'    => $request->epic_id
                ]);
            } else {
                EpicAccount::where('user_id', $request->id)->update([
                    'name' => $request->epic_id
                ]);
            }
        }
        $userExist->syncRoles($role);
        return $user;
    }

    public function scopeDeleteUser($query,$id){
        return $query->find($id)->delete();
    }

    public function scopeDeleteParticipation($query,$request){
        return $query->find($request->id)->tournaments()->detach($request->tournament_id);
    }

    public function FullName(){
        return $this->name . ' ' . $this->lastname;
    }
}
