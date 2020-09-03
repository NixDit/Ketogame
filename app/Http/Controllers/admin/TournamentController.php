<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Http\Controllers\admin\LogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use App\Exports\PlayersExport;
use Maatwebsite\Excel\Facades\Excel;

class TournamentController extends Controller
{
    /**
     * Display a listing of the tournaments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::GetAllTournaments();
        setlocale(LC_ALL, 'es_ES');
        return view('admin.pages.tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new tournament.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tournaments.create');
    }

    /**
     * Store a newly created tournament in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error     = false;
        $message   = null;
        $errorData = null;
        try {
            $tournament_created = Tournament::CreateTournament($request);
            if($tournament_created){
                LogController::newLog('created',Auth::user()->id,'Creación del torneo: '.$request->name);
                $message = 'Torneo registrado correctamente';
            } else {
                $error   = true;
                $message = 'No se pudo registrar el torneo';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error al procesar el registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'      => $error,
            'message'    => $message,
            'errorData'  => $errorData,
            'redirectTo' => 'torneos'
        ]);
    }

    /**
     * Display the specified tournament.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified tournament.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $error      = false;
        $message    = null;
        $errorData  = null;
        $tournament = null;
        try {
            if(filter_var($id,FILTER_VALIDATE_INT) && (int)$id > 0){
                $tournament_obtained = Tournament::GetTournament($id);
                if(!is_null($tournament_obtained)){
                    $tournament = $tournament_obtained;
                } else {
                    $error   = true;
                    $message = 'Torneo no encontrado';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error al obtener datos del registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'      => $error,
            'message'    => $message,
            'errorData'  => $errorData,
            'data' => $tournament
        ]);
    }

    /**
     * Update the specified tournament in storage.
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
        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $tournament         = Tournament::find($request->id);
                $tournament_created = Tournament::UpdateTournament($request);
                if($tournament_created){
                    LogController::newLog('edited',Auth::user()->id,'Actualización del torneo: '.$tournament->name.'"');
                    $message = 'Torneo actualizado correctamente';
                } else {
                    $error   = true;
                    $message = 'No se pudo actualizar el torneo';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error al procesar el registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    /**
     * Remove the specified tournament from storage.
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
                $tournament         = Tournament::find($id);
                $tournament_deleted = Tournament::DeleteTournament($id);
                if($tournament_deleted){
                    LogController::newLog('deleted',Auth::user()->id,'Eliminación del torneo: '.$tournament->name.'"');
                    $message = 'Torneo eliminado correctamente';
                } else {
                    $error   = true;
                    $message = 'No se pudo eliminar el torneo';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error al procesar el registro';
            $errorData = $th->getMessage();
        }
        return response()->json([
            'error'     => $error,
            'message'   => $message,
            'errorData' => $errorData
        ]);
    }

    public function changeStatus(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;
        $data      = (object)[];
        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $data->id = $request->id;
                switch($request->status){
                    case 'active':
                            $data->status = 1;
                            $data->text   = 'activo';
                        break;
                    case 'close':
                            $data->status = 2;
                            $data->text   = 'cerrado';
                        break;
                    default:
                            $data->status = null;
                        break;
                }
                if(!is_null($data->status)){
                    $statusTournament = Tournament::ChangeStatusTournament($data);
                    if($statusTournament){
                        $message = 'El torneo ahora está '.$data->text;
                    } else {
                        $error   = true;
                        $message = 'No se pudo actualizar el torneo';
                    }
                }
                else {
                    $error   = true;
                    $message = 'Estatus de cambio inválido';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante en proceso';
            $errorData = $th->getMessage();
        }
        
        return response()->json([
            'error' => $error,
            'message' => $message,
            'errorData' => $errorData
        ]);
    }
    
    public function showUserByTournament($id){
        $tournament = Tournament::GetTournament($id);
        return view('admin.pages.tournaments.players_tournament',compact('tournament'));
    }

    public function excel_tournament($id,$complete,$incomplete){
        $tournament      = Tournament::GetTournament($id);
        $data            = $tournament->players;
        $incompleteUsers = collect();
        $completeUsers   = collect();
        foreach($data as $player){
            // dd($player->pivot->picture_1);
            if($player->pivot->picture_1 != null && $player->pivot->picture_2 != null && $player->pivot->picture_3 != null 
                && $player->pivot->picture_4 != null && $player->pivot->picture_5 != null)
            {
                $completeUsers->push($player);
            } else {
                $incompleteUsers->push($player);
            }
        }
        if(($incomplete === "true" && $complete === "true") || ($incomplete === "false" && $complete === "false")){
            $data = $data;
        } else if($incomplete == "true"){
            $data = $incompleteUsers;
        } else if($complete == "true"){
            $data = $completeUsers;
        }
        if(!is_null($tournament) && count($data) > 0){
            return Excel::download(new PlayersExport($data->chunk(100)),strtoupper($tournament->name).'_JUGADORES_'.date('d-m-Y').'.xlsx');
        } else {
            return back()->with('warning','Sin registros disponibles');
        }
    }

    public function setChampion(Request $request){
        $error     = false;
        $message   = null;
        $errorData = null;
        $data      = (object)[];
        try {
            if(filter_var($request->id,FILTER_VALIDATE_INT) && (int)$request->id > 0){
                $statusTournament = Tournament::SetChampion($request);
                if($statusTournament){
                    $message = 'Asignación de campeón correcta';
                } else {
                    $error   = true;
                    $message = 'No se pudo actualizar el torneo';
                }
            } else {
                $error   = true;
                $message = 'ID inválido';
            }
        } catch (\Throwable $th) {
            $error     = true;
            $message   = 'Ocurrió un error durante en proceso';
            $errorData = $th->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'errorData' => $errorData
        ]);
    }
}
