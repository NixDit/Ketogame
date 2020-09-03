<?php

namespace App\Http\Controllers;
use App\User;
use App\Log;

use Illuminate\Http\Request;

class FunctionsController extends Controller
{
    public function setDarkMode(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;
        try {
            $userUpdate = User::SetDarkMode($request);
            if($userUpdate){
                $message = 'Modo de visualización actualizado';
            } else {
                $error   = true;
                $message = 'Ocurrió un error al asignar preferencia';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    public function InactiveLog(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;
        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $logUpdate = Log::InactiveLog($request->id);
                if($logUpdate){
                    $message = 'Éxito';
                } else {
                    $error   = true;
                    $message = 'Ocurrió un error durante el proceso';
                }    
            } else {
                $error   = true;
                $message = 'Notificación inválida';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    public function InactiveAllLog(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;
        try {
            $logsUpdate = Log::InactiveAllLog();
            if($logsUpdate){
                $message = 'Notificaciones eliminadas';
            } else {
                $error   = true;
                $message = 'Ocurrió un error durante el proceso';
            }   
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }
}
