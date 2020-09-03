<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\LogController;
use App\Mail\MessageRecieved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function sendMessage(){
    	$msg = request()->validate([
    		'name' 				=> 'required',
    		'email'				=> 'required|email',
    		'content'			=> 'required|min:3'
    	], [
    		'name.required'		=> 'Debes ingresar tu nombre'
    	]);
    	try {
    		Mail::to('josmarmp96@gmail.com')->queue(new MessageRecieved($msg));
			LogController::newLog('email', 4 , 'Recibiste email de: ' . request()->email);
			return redirect()->back()->with('success', 'Su correo ha sido enviado correctamente y le responderemos lo antes posible.');
    	} catch (Exception $e) {
    		return redirect()->back()->with('error', 'Ocurrio un error al intentar enviar el mensaje intente mas tarde.');
    	}



    }
}
