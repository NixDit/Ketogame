<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    public static function allLogs(){
        try {
            $logs = Log::GetAllLogs();
            if(count($logs) > 0){
                return $logs;
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function newLog($type,$user_id,$description){
        try {
            if(filter_var($user_id,FILTER_VALIDATE_INT) && (int)$user_id > 0){
                $log_created = Log::CreateNewLog($type,$user_id,$description);
                if($log_created){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function dontReadLogs(){
        try {
            $logs = Log::NoRead();
            if(count($logs) > 0){
                return $logs;
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
