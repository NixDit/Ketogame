<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\LogController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\User;

class AdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::GetAllUsers();
        return view('admin.pages.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.admins.create');
    }

    /**
     * Store a newly created resource in storage.
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
            $exist_data = new AdminUsersController();
            $exist_data = $exist_data->checkRepeatData($request);
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
                $userCreated = User::CreateNewAdmin($request,$urlImg,$request->role);
        
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
            'redirectTo' => 'administradores'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
                $adminObtained = User::GetUser($id);
                if(!is_null($adminObtained)){
                    $user = $adminObtained;
                } else {
                    $error   = true;
                    $message = 'Administrador no encontrado';
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
     * Update the specified resource in storage.
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
                $exist_data = new AdminUsersController();
                $exist_data = $exist_data->checkRepeatData($request);
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
                    $user        = User::find($request->id);
                    $userCreated = User::UpdateAdmin($request,$urlImg,$request->role);
                    if($userCreated == true){
                        LogController::newLog('edited',Auth::user()->id,'Actualización del usuario: '.$user->name.'"');    
                        $message = 'Actualización exitosa';
                    } else {
                        $error   = true;
                        $message = 'No se pudo actualizar';
                        $errorData = $userCreated['errorData'];
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteUser = new AdminUsersController();
        return $deleteUser->destroy($id);
    }
}
