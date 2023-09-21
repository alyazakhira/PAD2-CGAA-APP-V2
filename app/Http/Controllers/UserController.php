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
                $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/users/'.session('user'));
                $response1 = json_decode($apiResponse1->body());
                $user = $response1->data;

                $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/session/'.session('user'));
                $response2 = json_decode($apiResponse2->body());
                $session = $response2->data;
                $date = [];
                $score = [];
                $latestPusat = null;
                $latestDaerah = null;
                if ($session != null) {
                    foreach ($session as $s) {
                        array_push($date,date('d-m-Y',strtotime($s->created_at)));
                        array_push($score,$s->score);
                        if ($s->type == 'pusat') {
                            $latestPusat = $s;
                        } elseif ($s->type == 'daerah') {
                            $latestDaerah = $s;
                        }
                    }
                }

                $apiResponse3 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/average-score/'.session('user'));
                $response3 = json_decode($apiResponse3->body());
                $average = $response3->data->average;

                return view('user.dashboard', compact('user', 'session', 'average', 'date', 'score', 'latestPusat', 'latestDaerah'));
            }
        } else {
            return view('sign-in');
        }
    }

    public function history(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return redirect()->route('admin.dashboard');
            } else {
                $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/users/'.session('user'));
                $response1 = json_decode($apiResponse1->body());
                $user = $response1->data;

                $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/user-session/'.session('user'));
                $response2 = json_decode($apiResponse2->body());
                $session = $response2->data;

                return view('user.history', compact('user', 'session'));
            }
        } else {
            return view('sign-in');
        }
        
    }
}
