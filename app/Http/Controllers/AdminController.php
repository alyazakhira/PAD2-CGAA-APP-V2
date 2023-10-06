<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function dashboard(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                // Retrieve Session Data
                $sessions = json_decode(Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/exam-session')->body())->data;
                $session_count = collect($sessions)->count();
                $date = [];
                $value = [];
                $counter = 0;
                $helper = null;
                foreach ($sessions as $s) {
                    if (date('d-m-Y', strtotime($s->created_at)) == date('d-m-Y', strtotime($helper))) {
                        $counter += 1;

                    } elseif ($helper == null) {
                        $helper = $s->created_at;
                        $counter = 1;

                    } else {
                        array_push($value, $counter);
                        array_push($date, date('d-m-Y', strtotime($helper)));
                        $helper = $s->created_at;
                        $counter = 1;
                    }
                }
                array_push($date, date('d-m-Y', strtotime($helper)));
                array_push($value, $counter);

                // Retrieve Question Data
                $mpData = json_decode(Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/multiple-choice')->body())->data;
                $eyData = json_decode(Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/essay')->body())->data;
                $csData = json_decode(Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/case-study')->body())->data;
                $question_count = collect($mpData)->count() + collect($eyData)->count() + collect($csData)->count();

                // Retrieve User Data
                $userData = json_decode(Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/users')->body())->data;
                $user_count = collect($userData)->count();
                $colleger = 0;
                $non_colleger = 0;
                foreach ($userData as $u) {
                    if ($u->occupation == "Mahasiswa") {
                        $colleger += 1;
                    } else {
                        $non_colleger += 1;
                    }
                }
                return view('admin.dashboard', compact('session_count', 'question_count', 'user_count', 'date', 'value', 'colleger', 'non_colleger'));
            } else {
                return redirect()->route('user.dashboard');
            }          
        } else {
            return redirect()->route('login.show');
        }        
    }

    public function user_index($page){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                $userDataRaw = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/user/10?page='.$page);
                $userData = json_decode($userDataRaw->body());
                $content = $userData->data;
                return view('admin.user-index', compact('content'));
            } else {
                return redirect()->route('user.dashboard');
            }    
        } else {
            return redirect()->route('login.show');
        }
    }

    // Multiple Choice Functions
        public function mp_index_pusat($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/multiple-choice/pusat/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.multiple-choice.index-pusat', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function mp_index_daerah($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/multiple-choice/daerah/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.multiple-choice.index-daerah', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function mp_show($mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    $mp = $response->data;
                    return view('admin.multiple-choice.show', compact('mp'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
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
                return redirect()->route('login.show');
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
                    $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/multiple-choice',[
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
                return redirect()->route('login.show');
            }
        }

        public function mp_edit($mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    $mp = $response->data;
                    return view('admin.multiple-choice.edit', compact('mp'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
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
                    $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/multiple-choice/'.$mp_id,[
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
                return redirect()->route('login.show');
            }
        }

        public function mp_delete(Request $request, $mp_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->delete(env('API_PREFIX').'v2/multiple-choice/'.$mp_id);
                    $response = json_decode($apiResponse->body());
                    return redirect()->route('admin.mp.index.pusat', 1)->with('message', 'Berhasil menghapus soal pilihan ganda dengan ID '.$mp_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }
    // End of Multiple Choice Functions

    // Essay Functions
        public function ey_index_pusat($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/essay/pusat/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.essay.index-pusat', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function ey_index_daerah($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/essay/daerah/10?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.essay.index-daerah', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function ey_show($ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    $ey = $response->data;
                    return view('admin.essay.show', compact('ey'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
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
                return redirect()->route('login.show');
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
                    $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/essay',[
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
                return redirect()->route('login.show');
            }
        }

        public function ey_edit($ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    $ey = $response->data;
                    return view('admin.essay.edit', compact('ey'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
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
                    $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/essay/'.$ey_id,[
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
                return redirect()->route('login.show');
            }
        }

        public function ey_delete(Request $request, $ey_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->delete(env('API_PREFIX').'v2/essay/'.$ey_id);
                    $response = json_decode($apiResponse->body());
                    return redirect()->route('admin.ey.index.pusat', 1)->with('message', 'Berhasil menghapus soal esai dengan ID '.$ey_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }
    // End of Essay Functions

    // Case Study Functions
        public function cs_index_pusat($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/case-study/pusat/5?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.case-study.index-pusat', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_index_daerah($page){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/paginated/case-study/daerah/5?page='.$page);
                    $response = json_decode($apiResponse->body());
                    $content = $response->data;
                    return view('admin.case-study.index-daerah', compact('content'));
                } else {
                    return redirect()->route('user.dashboard');
                }    
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_show($cs_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/case-study/'.$cs_id);
                    $response = json_decode($apiResponse->body());
                    $cs = $response->data;
                    return view('admin.case-study.show', compact('cs'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_create(){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    return view('admin.case-study.create');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_store(Request $request){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    // General validation
                    $request->validate([
                        'question_type' => 'required',
                        'information' => 'required',
                        'instruction_count' => 'required',
                    ]);

                    // Count instruction
                    $temp = 0;
                    for ($i=1; $i <= 10; $i++) { 
                        if ($request->{"instruction_$i"}) {
                            $temp += 1;
                        }
                    }

                    // Response
                    if ($temp == $request->instruction_count) {
                        $formData = array();
                        $formData['question_type'] = $request->question_type;
                        $formData['information'] = $request->information;
                        $formData['instruction_count'] = $request->instruction_count;
                        for ($i=1; $i <= 10; $i++) {
                            $formData["instruction_$i"] = $request->{"instruction_$i"};
                            $formData["key_answer_$i"] = $request->{"key_answer_$i"};
                        }
                        $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/case-study',$formData);
                        $response = json_decode($apiResponse->body());
                        $question = $response->data;
                        return redirect()->route('admin.cs.index.'.$request->question_type, 1)->with('message', 'Berhasil menambahkan soal studi kasus dengan ID '.$question->id.'!');
                    } else {
                        return back()->withErrors("The instruction count do not match!");
                    }
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_edit($cs_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->get(env('API_PREFIX').'v2/case-study/'.$cs_id);
                    $response = json_decode($apiResponse->body());
                    $cs = $response->data;
                    return view('admin.case-study.edit', compact('cs'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_update(Request $request, $cs_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    // General validation
                    $request->validate([
                        'question_type' => 'required',
                        'information' => 'required',
                        'instruction_count' => 'required',
                    ]);

                    // Count instruction
                    $temp = 0;
                    for ($i=1; $i <= 10; $i++) { 
                        if ($request->{"instruction_$i"}) {
                            $temp += 1;
                        }
                    }

                    // Response
                    if ($temp == $request->instruction_count) {
                        $formData = array();
                        $formData['question_type'] = $request->question_type;
                        $formData['information'] = $request->information;
                        $formData['instruction_count'] = $request->instruction_count;
                        $formData['_method'] = 'PUT';
                        for ($i=1; $i <= 10; $i++) {
                            $formData["instruction_$i"] = $request->{"instruction_$i"};
                            $formData["key_answer_$i"] = $request->{"key_answer_$i"};
                        }
                        $apiResponse = Http::withToken(session('bearer'))->post(env('API_PREFIX').'v2/case-study/'.$cs_id,$formData);
                        $response = json_decode($apiResponse->body());
                        $question = $response->data;
                        return redirect()->route('admin.cs.index.'.$request->question_type, 1)->with('message', 'Berhasil mengubah soal studi kasus dengan ID '.$question->id.'!');
                    } else {
                        return back()->withErrors("The instruction count do not match!");
                    }
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }

        public function cs_delete(Request $request, $cs_id){
            if (session()->has('bearer')) {
                if (session('authorized')) {
                    $apiResponse = Http::withToken(session('bearer'))->delete(env('API_PREFIX').'v2/case-study/'.$cs_id);
                    $response = json_decode($apiResponse->body());
                    return redirect()->route('admin.cs.index.pusat', 1)->with('message', 'Berhasil menghapus soal studi kasus dengan ID '.$cs_id.'!');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('login.show');
            }
        }
    // End of Case Study Functions
}
