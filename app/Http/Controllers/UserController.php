<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function dashboard(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return redirect()->route('admin.dashboard');
            } else {
                $userDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/users/'.session('user'));
                $userData = json_decode($userDataRaw->body());
                $user = $userData->data;

                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/session/'.session('user'));
                $sessionData = json_decode($sessionDataRaw->body());
                $session = $sessionData->data;
                $date = [];
                $score = [];
                $latestPusat = null;
                $latestDaerah = null;
                if ($session != null) {
                    foreach ($session as $s) {
                        array_push($date,date('d-m-Y',strtotime($s->created_at)));
                        array_push($score,$s->mp_score);
                        if ($s->type == 'pusat') {
                            $latestPusat = $s;
                        } elseif ($s->type == 'daerah') {
                            $latestDaerah = $s;
                        }
                    }
                }

                $userAverageRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/average-score/'.session('user'));
                $userAverageData = json_decode($userAverageRaw->body());
                $average = $userAverageData->data->average;

                return view('user.dashboard', compact('user', 'average', 'date', 'score', 'latestPusat', 'latestDaerah'));
            }
        } else {
            return redirect()->route('login.show');
        }
    }

    public function history(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return redirect()->route('admin.dashboard');
            } else {
                $userDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/users/'.session('user'));
                $userData = json_decode($userDataRaw->body());
                $user = $userData->data;

                $userSessionRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/session/'.session('user'));
                $userSessionData = json_decode($userSessionRaw->body());
                $sessionFinished = [];
                $sessionUnfinished = [];
                foreach ($userSessionData->data as $data) {
                    if ($data->status > 0) {
                        array_push($sessionUnfinished, $data);
                    } else {
                        array_push($sessionFinished, $data);
                    }
                }

                return view('user.history', compact('user', 'sessionFinished', 'sessionUnfinished'));
            }
        } else {
            return redirect()->route('login.show');
        }
        
    }
}
