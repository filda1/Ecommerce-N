<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\MailQueue;
use App\Config;

class QueueController extends Controller
{
    public function processEmail(){

        $emails = MailQueue::where("status", "pending")->get();

        foreach ($emails as $email) {
            try {

                if (!filter_var($email->email, FILTER_VALIDATE_EMAIL)) {

                    $email->status = "error";
                    $email->save();

                    continue;
                }

                $var = json_decode($email->var);
                \Mail::send($email->view, ["var"=>$var], function ($message) use ($email){
                    $message->to($email->email)->subject($email->subject);
                    $message->from(config('mail.username')); 
                });

                $email->status = "success";
                $email->save();
            } catch (Exception $e) {
                $email->status = "error";
                $email->save();

                Log::error($e);
            }
        }
    }

    public function modificarDataPlano(Request $request){
        Log::info($request);
        $permission = $this->checkPermissions($request->type, $request->permission);

        if($permission["status"] != "ok"){
            return ["status" => "error", "message" => $permission["message"]];
        }

        $plan = Config::first();

        $plan->plan = $request->plan;
        $plan->plan_end = $request->end;
        $plan->plan_free = "";
        $plan->save();

        return ["status" => "ok", "message" => "Data do Plano modificada com sucesso."];
    }

    public function checkPermissions($type, $permission){
        $permissions = [
            "create_service_user" => "rVueF6nP2P"
        ];

        if(array_key_exists($type, $permissions)){
            if($permissions[$type] == $permission){
                return ["status" => "ok", "message" => null];
            }else{ 
                return ["status" => "error", "message" => "Permission Denied"];
            }
        }else{
            return ["status" => "error", "message" => "Permission Denied"];
        }
    }
}
