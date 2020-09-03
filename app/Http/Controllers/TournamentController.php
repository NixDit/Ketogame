<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Tournament;
use App\User;
use App\TournamentUser;
use Carbon\Carbon;
use File;



class TournamentController extends Controller
{
	public function index(){
		$tournaments = Tournament::where('active', 1)->first();
		return view('Tournament/show')->with('tournaments', $tournaments);
	}

	public function showTournaments(){
		$data 					= (object)[]; // Cast empty array to object
		$today 					= Carbon::now()->format('Y-m-d');
		$data->current_date 	= $today;
		$data->tournaments		= Tournament::where('active', 1)->orWhere('active', 2)->where('start_date', '>=', $today )->get();


		//BEGIN PERCENTAGE CALCULATED
		if(Auth::check()){
			foreach($data->tournaments as $key => $tournament){
				$number_of_pictures = 0;
				$percentage			= 0;
				$record	= TournamentUser::where('tournament_id', $tournament->id)
										->where('user_id', Auth::user()->id)
										->first();
				if($record){
					$tournament['picture_1'] 	= $record->picture_1;
					$tournament['picture_2'] 	= $record->picture_2;
					$tournament['picture_3'] 	= $record->picture_3;
					$tournament['picture_4'] 	= $record->picture_4;
					$tournament['picture_5'] 	= $record->picture_5;

					if($tournament['picture_1'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_2'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_3'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_4'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_5'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					$tournament['percentage'] = $percentage;
				}
			}
		}
		if(Auth::check()){
			$data->my_tournaments 	= Auth::user()->tournaments()->where('active', '!=', 0)->get();
			foreach($data->my_tournaments as $key => $tournament){
				$number_of_pictures = 0;
				$percentage			= 0;
				$record	= TournamentUser::where('tournament_id', $tournament->id)
										->where('user_id', Auth::user()->id)
										->first();
				if($record){
					$tournament['picture_1'] 	= $record->picture_1;
					$tournament['picture_2'] 	= $record->picture_2;
					$tournament['picture_3'] 	= $record->picture_3;
					$tournament['picture_4'] 	= $record->picture_4;
					$tournament['picture_5'] 	= $record->picture_5;

					if($tournament['picture_1'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_2'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_3'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_4'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					if($tournament['picture_5'] != null ){
						$number_of_pictures += 1;
						$percentage			+= 20;
					}
					$tournament['percentage'] = $percentage;
				}
			}
		}
		return view('Tournament.index')->with('data', $data);
	}

	public function signMeUp(Request $request){
		$message			= "";
		$type				= "";
		$error	 			= false;
		$picture_1 			= "";
		$picture_2 			= "";
		$picture_3 			= "";
		$picture_4 			= "";
		$picture_5 			= "";

		$user 				= User::find($request->user_id);
		$record				= TournamentUser::where('tournament_id', $request->tournament_id)
								->where('user_id', $user->id)
								->first();
		$tournament 		= Tournament::find($request->tournament_id);
		$total_participants = $tournament->players->count();
		// IF USER IS ALREADY REGISTERED IN TOURNAMENT
		if($record){
			$message 		= "Ya te encuentras registrado, tan solo necesitas mostrarme tu apoyo en las redes sociales siguientes.";
			$type 			= "success";
			$picture_1 		= $record->picture_1;
			$picture_2 		= $record->picture_2;
			$picture_3 		= $record->picture_3;
			$picture_4 		= $record->picture_4;
			$picture_5 		= $record->picture_5;
		}else{
			// CREATE TOURNAMENT-USER RECORD
			try {
				if($total_participants < $tournament->max_participants){
					$user->tournaments()->attach($request->tournament_id); //USING ATTACH CAUSE SYNC DELETES A ROW
					$total_participants 		+= 1;
					$update_participants 		= $tournament->update([
									                'total_participants' => $total_participants
									            ]);
					if($total_participants == $tournament->max_participants){
						$close_tournament = Tournament::CloseTournament($request->tournament_id);
					}
					$message 	= "Te has registrado exitosamente, ahora solo necesitas mostrarme tu apoyo en las redes sociales siguientes.";
					$type 		= "success";
				}else{
					$message 	= "El numero de participantes admitidos en este torneo ha llegado a su limite.";
					$type 		= "info";
				}


			} catch (Exception $e) {
				$message	= "Ocurrio un error al momento de registrarte, intentalo mas tarde.";
				$type 		= "error";
				$error 		= true;
			}
		}

		return response()->json([
            'error'     	=> $error,
            'message'   	=> $message,
            'type'			=> $type,
            'picture_1'		=> $picture_1,
            'picture_2'		=> $picture_2,
            'picture_3'		=> $picture_3,
            'picture_4'		=> $picture_4,
            'picture_5'		=> $picture_5
        ]);
	}

	public function sendImages(Request $request){
		$message 	= "";
		$error 		= false;
		try {
			$record							= TournamentUser::where('tournament_id', $request->tournament_id)
															->where('user_id', $request->user_id)
															->first();

			for ($i=1; $i < 6; $i++) {
				if ($request->hasFile('picture_'.$i)) {
					$record_old_picture 	= TournamentUser::where('tournament_id', $request->tournament_id)
															->where('user_id', $request->user_id)
															->pluck('picture_'.$i); //THIS LINE IS FOR GETTING JUST OLD PICTURE NAME
		            $date           		= Carbon::now();
		            $targets        		= array(' ', ':');
		            $date           		= str_replace($targets, '-', $date);
		            $image          		= $request->file('picture_'.$i);
		            $fileName       		= 'print-screen-'. $i . '-' . $request->user_id . '-' . $date . '.' . $image->getClientOriginalExtension(); //TO AVOID DUPLICATED NAMES
		            $img            		= Image::make($image->getRealPath());

					// Se comento a razón que en el modal-img se perdía un poco de resolución al mostrar la imagen
		            $img->resize(800, 720, function ($constraint) {
		                $constraint->aspectRatio();
		            });

		            $img->stream(); // <-- Key point
		            $upload_image 			= Storage::disk('local')->put('public/print-screens/'.$fileName, $img, 'public');

		            $update_image 			= $record->update([
		                'picture_'.$i   	=> $fileName
		            ]);

	            	//IF PICTURE WAS UPDATED DELETE OLD FILE
	            	if($update_image){
	                	$image_path 		= "/public/print-screens/" . $record_old_picture[0]; //[0] BECAUSE IS AN ARRAY WITH ONE ELEMENT THAT CONTAINS THE FILE NAME TO DELETE
	                	Storage::delete($image_path);
	            	}
	       		}
			}
			$message 						= "Tus imagenes se han subido y seran revisadas por algun administrador";
		} catch (Exception $e) {
			$message 						= "Ocurrio un error al tratar de subir tus imagenes, intenta de nuevo mas tarde";
			$error 							= true;
		}
		return response()->json([
            'error'     => $error,
            'message'   => $message
        ]);
	}

	public function isRegistered($user_id, $tournament_id){
		$record	= TournamentUser::where('tournament_id', $tournament_id)
								->where('user_id', $user_id)
								->get();
		return $record ? true : false;
	}

	public function sendToLogin(){
		return $this->showTournaments();
	}
}
