<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\admin\LogController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Tournament;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the user-registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = User::GetAllUsers();
        return view('admin.pages.players.index',compact('players'));
    }

    /**
     * Show the form for creating a new user-registered.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.players.create');
    }

    /**
     * Store a newly created user-registered in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error     = false;
        $message   = null;
        $errorData = null;
        $urlImg    = null;
        try {
            $exist_data = $this->checkRepeatData($request);
            if($exist_data['status'] == true){
                if ($request->hasFile('profile_picture')) {
                    $date    = Carbon::now();
                    $targets = array(' ', ':');
                    $date    = str_replace($targets, '-', $date);
                    $image   = $request->file('profile_picture');
                    $urlImg  = 'profile-picture-' . $date . '.' . $image->getClientOriginalExtension();
                    $img     = Image::make($image->getRealPath());
        
                    $img->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });
        
                    $img->stream();
                    Storage::disk('local')->put('public/avatars/'.$urlImg, $img, 'public');
                }
                $userCreated = User::CreateNewUser($request,$urlImg);
        
                if($userCreated == true){
                    LogController::newLog('created',Auth::user()->id,'Creación del usuario: '.$request->name);
                    $message = 'Registro exitoso';
                } else {
                    $error   = true;
                    $message = 'No se pudo completar el registro';
                    $errorData = $userCreated['errorData'];
                }    
            } else {
                return response()->json([
                    'error'     => true,
                    'message'   => $exist_data['msg']
                ]);
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante el registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'      => $error,
            'message'    => $message,
            'errorData'  => $errorData,
            'redirectTo' => 'jugadores'
        ]);
    }

    /**
     * Display the specified user-registered.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified user-registered.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $error     = false;
        $message   = null;
        $errorData = null;
        $user      = null;
        try {
            if(filter_var($id,FILTER_VALIDATE_INT) && (int)$id > 0){
                $userObtained = User::GetUser($id);
                if(!is_null($userObtained)){
                    $user = $userObtained;
                } else {
                    $error   = true;
                    $message = 'Usuario no encontrado';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante el proceso';
            $errorData = $th->getMessage();
        }

        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData,
            'data'      => $user
        ]);
    }

    /**
     * Update the specified user-registered in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error     = false;
        $message   = null;
        $errorData = null;
        $urlImg    = null;
        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $exist_data = $this->checkRepeatData($request);
                if($exist_data['status'] == true){
                    $existUser = User::GetUser($request->id);
                    // check Image
                    if(!is_null($existUser->profile_picture)){
                        $urlImg = $existUser->profile_picture;
                    }
                    if ($request->hasFile('profile_picture')) {
                        $date    = Carbon::now();
                        $targets = array(' ', ':');
                        $date    = str_replace($targets, '-', $date);
                        $image   = $request->file('profile_picture');
                        $urlImg  = 'profile-picture-' . $date . '.' . $image->getClientOriginalExtension();
                        $img     = Image::make($image->getRealPath());
            
                        $img->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            
                        $img->stream();
                        Storage::disk('local')->put('public/avatars/'.$urlImg, $img, 'public');
                    }
                    $user       = User::find($request->id);
                    $userEdited = User::UpdateUser($request,$urlImg);
                    if($userEdited == true){
                        LogController::newLog('edited',Auth::user()->id,'Actualización del usuario: '.$user->name.'"');    
                        $message = 'Actualización exitosa';
                    } else {
                        $error   = true;
                        $message = 'No se pudo actualizar';
                        $errorData = $userEdited['errorData'];
                    }
                } else{
                    return response()->json([
                        'error'     => true,
                        'message'   => $exist_data['msg']
                    ]);
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante el registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    public function checkRepeatData($data){
        $users     = User::GetAllUsersWithTrashed();
        $status    = true;
        $msg       = null;
        if(isset($data->id)){
            $existUser = User::GetUser($data->id);
            if($existUser->email != $data->email){
                foreach($users as $user){
                    if($user->email == $data->email){
                        $status = false;
                        $msg    = 'El email ingresado ya se encuentra registrado';
                        break;
                    }
                }
            }
            if($existUser->mobile != str_replace('-','',$data->mobile)){
                foreach($users as $user){
                    if($user->mobile == str_replace('-','',$data->mobile)){
                        $status = false;
                        $msg    = 'El teléfono ingresado ya se encuentra registrado';
                        break;
                    }
                }
            }
        } else {
            foreach($users as $user){
                if($user->mobile == str_replace('-','',$data->mobile)){
                    $status = false;
                    $msg    = 'El teléfono ingresado ya se encuentra registrado';
                    break;
                }
                if($user->email == $data->email){
                    $status = false;
                    $msg    = 'El email ingresado ya se encuentra registrado';
                    break;
                }
            }
        }
        return array(
            'status' => $status,
            'msg' => $msg
        );
    }

    /**
     * Remove the specified user-registered from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error     = false;
        $message   = null;
        $errorData = null;
        try {
            if(filter_var($id,FILTER_VALIDATE_INT) && (int)$id > 0){
                $user         = User::find($id);
                $user_deleted = User::DeleteUser($id);
                if($user_deleted){
                    LogController::newLog('deleted',Auth::user()->id,'Eliminación del usuario: '.$user->name.'"');        
                    $message = 'Usuario eliminado correctamente';
                } else {
                    $error   = true;
                    $message = 'No se pudo eliminar el usuario';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante el proceso';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    public function showTournamentsByUser($id){
        // dd($id);
        $player = User::GetUser($id);
        return view('admin.pages.players.tournaments_player',compact('player'));
    }

    public function deleteUserParticipation(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;

        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $user                       = User::find($request->id);
                $tournament                 = Tournament::find($request->tournament_id);
                $tournament->update([
                    'total_participants' => ((int)$tournament->players->count() - 1)
                ]);
                $user_deleted_participation = User::DeleteParticipation($request);
                if($user_deleted_participation){
                    LogController::newLog('deleted',Auth::user()->id,'Eliminación de participación del usuario "'.$user->name.'" en el torneo "'.$tournament->name.'"');        
                    $message = 'Usuario eliminado correctamente';
                } else {
                    $error   = true;
                    $message = 'No se pudo eliminar el usuario';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante el proceso';
            $errorData = $th->getMessage();
        }
        
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }
}
