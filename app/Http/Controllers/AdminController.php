<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function dashboard(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session');
                $response1 = json_decode($apiResponse1->body());
                $sessions = $response1->data;
                $session_count = collect($sessions)->count();
                $date = [];
                $value = [];
                $counter = 0;
                $d = null;
                foreach ($sessions as $s) {
                    if ($s->created_at == $d) {
                        $counter = $counter+1;

                    } elseif ($d == null) {
                        $d = $s->created_at;
                        $counter = 1;

                    } else {
                        array_push($value, $counter);
                        array_push($date, date('d-m-Y', strtotime($d)));
                        $d = $s->created_at;
                        $counter = 1;
                    }
                }
                array_push($date, date('d-m-Y', strtotime($d)));
                array_push($value, $counter);

                $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice');
                $response2 = json_decode($apiResponse2->body());
                $mp = $response2->data;
                $mp_count = collect($mp)->count();

                $apiResponse3 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/users');
                $response3 = json_decode($apiResponse3->body());
                $users = $response3->data;
                $user_count = collect($users)->count();
                $colleger = 0;
                $non_colleger = 0;
                foreach ($users as $u) {
                    if ($u->occupation == "Mahasiswa") {
                        $colleger = $colleger+1;
                    } else {
                        $non_colleger = $non_colleger+1;
                    }
                }
                return view('admin.dashboard', compact('sessions', 'mp', 'users', 'session_count', 'mp_count', 'user_count', 'date', 'value', 'colleger', 'non_colleger'));
            } else {
                return redirect()->route('user.dashboard');
            }          
        } else {
            return view('sign-in');
        }        
    }

    public function quest_index($page){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice-paginated/10?page='.$page);
                $response = json_decode($apiResponse->body());
                $content = $response->data;
                return view('admin.quest-index', compact('content'));
            } else {
                return redirect()->route('user.dashboard');
            }    
        } else {
            return view('sign-in');
        }
    }

    public function quest_create(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return view('admin.quest-create');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function quest_store(Request $request){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $request->validate([
                    'question_type' => 'required',
                    'question' => 'required',
                    'question_explanation' => 'required',
                    'answer_a' => 'required',
                    'answer_b' => 'required',
                    'answer_c' => 'required',
                    'answer_d' => 'required',
                    'correct_answer' => 'required',
                ]);
                $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/multiple-choice',[
                    'question_type' => $request->question_type,
                    'question' => $request->question,
                    'question_explanation' => $request->question_explanation,
                    'answer_a' => $request->answer_a,
                    'answer_b' => $request->answer_b,
                    'answer_c' => $request->answer_c,
                    'answer_d' => $request->answer_d,
                    'correct_answer' => $request->correct_answer,
                ]);
                $response = json_decode($apiResponse->body());
                $question = $response->data;
                return redirect()->route('admin.question.index', 1)->with('message', 'Berhasil menambahkan soal dengan ID'.$question->id.'!');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function quest_show($quest_id){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice/'.$quest_id);
                $response = json_decode($apiResponse->body());
                $mp = $response->data;
                return view('admin.quest-show', compact('mp'));
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function quest_edit($quest_id){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice/'.$quest_id);
                $response = json_decode($apiResponse->body());
                $mp = $response->data;
                return view('admin.quest-edit', compact('mp'));
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function quest_update(Request $request, $quest_id){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $request->validate([
                    'question_type' => 'required',
                    'question' => 'required',
                    'question_explanation' => 'required',
                    'answer_a' => 'required',
                    'answer_b' => 'required',
                    'answer_c' => 'required',
                    'answer_d' => 'required',
                    'correct_answer' => 'required',
                ]);
                $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/multiple-choice/'.$quest_id,[
                    'question_type' => $request->question_type,
                    'question' => $request->question,
                    'question_explanation' => $request->question_explanation,
                    'answer_a' => $request->answer_a,
                    'answer_b' => $request->answer_b,
                    'answer_c' => $request->answer_c,
                    'answer_d' => $request->answer_d,
                    'correct_answer' => $request->correct_answer,
                    "_method" => 'PUT',
                ]);
                $response = json_decode($apiResponse->body());
                $question = $response->data;
                return redirect()->route('admin.question.index', 1)->with('message', 'Berhasil memperbarui soal dengan ID '.$quest_id.'!');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function quest_delete(Request $request, $quest_id){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse = Http::withToken(session('bearer'))->delete('http://localhost:8000/api/v2/multiple-choice/'.$quest_id);
                $response = json_decode($apiResponse->body());
                return redirect()->route('admin.question.index', 1)->with('message', 'Berhasil menghapus soal dengan ID '.$quest_id.'!');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function user_index($page){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/user-paginated/10?page='.$page);
                $response = json_decode($apiResponse->body());
                $content = $response->data;
                return view('admin.user-index', compact('content'));
            } else {
                return redirect()->route('user.dashboard');
            }    
        } else {
            return view('sign-in');
        }
    }
}
