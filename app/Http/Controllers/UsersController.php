<?php

namespace App\Http\Controllers;

use App\Country;
use App\EpicAccount;
use App\User;
use Carbon\Carbon;
use File;
use Hash;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
use SweetAlert;

class UsersController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('user.profile')->with('countries', Country::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user               = User::find($request->user_id);    //FIND USER
        $msj                = "";

        // //USER WANTS TO CHANGE HIS or HER PASSWORD
        // if($request->new_password){
        //     if($request->current_password){
        //         if (Hash::check($request->current_password, $user->password)) {
        //             $user->update([
        //                 'password' => Hash::make($request->new_password)
        //             ]);
        //             $msj .= " SU CONTRASEÑA, ";
        //         }else
        //         return redirect()->back()->with('success', 'Su contraseña actual es incorrecta, no se pudo actualizar una nueva');
        //     }else{
        //         return redirect()->back()->with('success', 'Ingrese su contraseña actual para poder actualizarla');
        //     }
        // }

        // $user_old_picture   = $user->profile_picture;           //GET FILE DIRECTORY
        $update             = $user->update([                   //UPDATE BASIC INFO
                                'name'          => ucwords(strtolower($request->name)),
                                'lastname'      => ucwords(strtolower($request->lastname)),
                                'email'         => $request->email,
                                'mobile'        => $request->mobile
                            ]);

        // IF USER WANTS A NEW PROFILE PICTURE
        // if ($request->hasFile('profileImage')) {
        //     $date           = Carbon::now();
        //     $targets        = array(' ', ':');
        //     $date           = str_replace($targets, '-', $date);
        //     $image          = $request->file('profileImage');
        //     $fileName       = 'profile-picture-' . $date . '.' . $image->getClientOriginalExtension();
        //     $img            = Image::make($image->getRealPath());

        //     $img->resize(500, 500, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });

        //     $img->stream(); // <-- Key point
        //     $upload_image = Storage::disk('local')->put('public/avatars/'.$fileName, $img, 'public');
        //     $update_image = $user->update([
        //         'profile_picture'   => $fileName
        //     ]);

        //     //IF PROFILE PICTURE WAS UPDATED DELETE OLD FILE
        //     if($update_image){
        //         $image_path = "/public/avatars/" . $user_old_picture;
        //         Storage::delete($image_path);
        //     }
        // }

        //IF USER WANTS TO REGISTER HIS OR HER EPIC ID
        if($request->epic_id){
            //IF USER ALREADY HAS A REGISTER IN DB
            if($user->epic){
                $update_epic        = $user->epic->where('user_id', $request->user_id)->update([
                    'name'          =>$request->epic_id
                ]);
            // IF USER DOESNT HAVE ALREADY A REGISTER
            }else{
                $register = EpicAccount::create([
                    'user_id'       => $request->user_id,
                    'name'          =>$request->epic_id
                ]);
            }
        }

        $msj = "SUS DATOS HAN SIDO ACTUALIZADOS CORRECTAMENTE";

        return redirect()->back()->with('success', $msj);
    }

    public function updatefortnite(Request $request){
        $error = false;
        //IF USER ALREADY HAS EPIC ID REGISTERED THEN UPDATE HIS OR HER INFORMATION
        if(EpicAccount::EpicRegistered($request->user_id)){
            $update = $this->updateFortniteInfo($request);
            if($update){
                $msj = 'Estadisticas actualizadas correctamente';
            }else{
                $msj = 'Ocurrio un error al tratar de actualizar tus estadisticas, intente mas tarde';
                $error = true;
            }
        }else{
        //IF USER DOESNT HAS EPIC INFORMATION THEN CREATE A ROW
            $register = $this->registerFortniteInfo($request);
            if($register){
                $msj = 'Estadisticas registradas correctamente';
            }else{
                $msj = 'Ocurrio un error al tratar de registrar tus estadisticas, intente mas tarde';
                $error = true;
            }
        }
        return response()->json([
            'error'     => $error,
            'message'   => $msj
        ]);
    }
    public function registerFortniteInfo($request){
        $register_stats = EpicAccount::RegisterEpicStats($request);
        return $register_stats ? true : false;
    }
    public function updateFortniteInfo($request){
        $update_stats  = EpicAccount::UpdateEpicStats($request);
        return $update_stats ? true : false;
    }

    public function profileImage(Request $request){
        $user               = Auth::user();
        $user_old_picture   = $user->profile_picture;//GET FILE DIRECTORY
        $error              = true;
        $message            = "";
        $type               = "";
        $title              = "";

        if(substr($request->profileImage->getMimeType(), 0, 5) == 'image') {
            // IF USER WANTS A NEW PROFILE PICTURE
            if ($request->hasFile('profileImage')) {
                $date           = Carbon::now();
                $targets        = array(' ', ':');
                $date           = str_replace($targets, '-', $date);
                $image          = $request->file('profileImage');
                $fileName       = 'profile-picture-'. $user->id . '-' . $date . '.' . $image->getClientOriginalExtension();
                $img            = Image::make($image->getRealPath());

                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->stream(); // <-- Key point
                $upload_image = Storage::disk('local')->put('public/avatars/'.$fileName, $img, 'public');
                $update_image = $user->update([
                    'profile_picture'   => $fileName
                ]);

                //IF PROFILE PICTURE WAS UPDATED DELETE OLD FILE
                if($update_image){
                    $image_path = "/public/avatars/" . $user_old_picture;
                    Storage::delete($image_path);
                    $title   = "Correcto";
                    $message = "Foto de perfil actualizada correctamente";
                    $type    = "success";
                    $error   = false;
                }else{
                    $title   = "Error";
                    $message = "Ocurrio un error";
                    $type    = "error";
                }
            }
        }else{
            $title           = "Error";
            $message         = "El archivo debe ser una imagen";
            $type            = "error";
        }



        return response()->json([
            'error'     => $error,
            'title'     => $title,
            'message'   => $message,
            'type'      => $type
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
        //
    }
}
