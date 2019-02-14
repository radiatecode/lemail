<?php

namespace App\Http\Controllers;

use App\Log;
use App\Receiver;
use App\Sender;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Dash Board For User
     * @return mixed
     */
    public function userDashboard(){
        $sent =  $sender = Sender::with('message')
            ->where('sender_id',Auth::user()->id)
            ->orderBy('id','DESC')
            ->get();

        $receiver = User::find(Auth::user()->id);
        $inbox = $receiver->message_receiver;

        $read = Receiver::where('receiver_id',Auth::user()->id)
            ->whereNotNull('read_at')->get();

        $logs = Log::where('user_id',Auth::user()->id)
            ->orderBy('id','DESC')
            ->take(20)
            ->get();

        return view('user.dashboard.dashboard')
            ->with('logs',$logs)
            ->with('read',count($read))
            ->with('sent',count($sent))
            ->with('inbox',count($inbox));
    }

    /**
     * Dash Board For Admin
     * @return mixed
     */
    public function adminDashboard(){
        $lost = 0; $return = 0;
        $total_users = User::all();
        $active_users = User::where('active',1)->get();
        foreach ($total_users as $user){
            $lastLogin = $user->log->last();
            $loginDate = $lastLogin['date'];
            $lastTime = new \DateTime(date($loginDate));
            $today = new \DateTime(date('Y-m-d H:i:s'));
            $difference = $lastTime->diff($today);
            if ($difference->d >= 2 || $loginDate==null){
                $lost++;
            }else{
                $return++;
            }
        }
        return view('admin.dashboard.dashboard')
            ->with('total_users',$total_users)
            ->with('active_users',$active_users)
            ->with('lost',$lost)
            ->with('return',$return);
    }

}
