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

    public function scoring_form(){
        return view('additional.under-dev');
    }

    public function scoring_store(Request $request){

    }

    // Multiple Choice Functions
        public function mp_index_pusat($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice-paginated-pusat/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.multiple-choice.index-pusat', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return view('sign-in');
            }
        }

        public function mp_index_daerah($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice-paginated-daerah/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.multiple-choice.index-daerah', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return view('sign-in');
            }
        }

        public function mp_show($mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    $mp = $response->data;
                    return view('admin.multiple-choice.show', compact('mp'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function mp_create(){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    return view('admin.multiple-choice.create');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function mp_store(Request $request){
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
                    return redirect()->route('admin.mp.index.'.$request->question_type, 1)->with('message', 'Berhasil menambahkan soal pilihan ganda dengan ID '.$question->id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function mp_edit($mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    $mp = $response->data;
                    return view('admin.multiple-choice.edit', compact('mp'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function mp_update(Request $request, $mp_id){
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
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/multiple-choice/'.$mp_id,[
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
                    return redirect()->route('admin.mp.index.'.$request->question_type, 1)->with('message', 'Berhasil memperbarui soal pilihan ganda dengan ID '.$mp_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function mp_delete(Request $request, $mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->delete('http://localhost:8000/api/v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    return redirect()->route('admin.mp.index.pusat', 1)->with('message', 'Berhasil menghapus soal pilihan ganda dengan ID '.$mp_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }
    // End of Multiple Choice Functions

    // Essay Functions
        public function ey_index_pusat($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/essay-paginated-pusat/5?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.essay.index-pusat', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return view('sign-in');
            }
        }

        public function ey_index_daerah($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/essay-paginated-daerah/5?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.essay.index-daerah', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return view('sign-in');
            }
        }

        public function ey_show($ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    $ey = $response->data;
                    return view('admin.essay.show', compact('ey'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function ey_create(){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    return view('admin.essay.create');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function ey_store(Request $request){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $request->validate([
                        'question_type' => 'required',
                        'question' => 'required',
                        'correct_answer' => 'required',
                    ]);
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/essay',[
                        'question_type' => $request->question_type,
                        'question' => $request->question,
                        'correct_answer' => $request->correct_answer,
                    ]);
                    $response = json_decode($apiResponse->body());
                    $question = $response->data;
                    return redirect()->route('admin.ey.index.'.$request->question_type, 1)->with('message', 'Berhasil menambahkan soal esai dengan ID '.$question->id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function ey_edit($ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    $ey = $response->data;
                    return view('admin.essay.edit', compact('ey'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function ey_update(Request $request, $ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $request->validate([
                        'question_type' => 'required',
                        'question' => 'required',
                        'correct_answer' => 'required',
                    ]);
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/essay/'.$ey_id,[
                        'question_type' => $request->question_type,
                        'question' => $request->question,
                        'correct_answer' => $request->correct_answer,
                        "_method" => 'PUT',
                    ]);
                    $response = json_decode($apiResponse->body());
                    $question = $response->data;
                    return redirect()->route('admin.ey.index.'.$request->question_type, 1)->with('message', 'Berhasil memperbarui soal esai dengan ID '.$ey_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }

        public function ey_delete(Request $request, $ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->delete('http://localhost:8000/api/v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    return redirect()->route('admin.ey.index.pusat', 1)->with('message', 'Berhasil menghapus soal esai dengan ID '.$ey_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return view('sign-in');
            }
        }
    // End of Essay Functions

    // Case Study Functions
        public function cs_index_pusat($page){
            return view('additional.under-dev');
        }

        public function cs_index_daerah($page){
            return view('additional.under-dev');
        }

        public function cs_show($cs_id){
            return view('additional.under-dev');
        }

        public function cs_create(){
            return view('additional.under-dev');
        }

        public function cs_store(Request $request){
            // 
        }

        public function cs_edit($cs_id){
            return view('additional.under-dev');
        }

        public function cs_update(Request $request, $cs_id){
            // 
        }

        public function cs_delete(Request $request, $cs_id){

        }
    // End of Case Study Functions
}
