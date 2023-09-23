<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SimulationController extends Controller
{
    // Exam Starter Pack Functions
        public function select_exam_type(){
            if (session()->has('bearer')) {
                return view('exam.starter.select-type');
            } else {
                return redirect()->route('login.show');
            }
        }

        public function show_instruction_pusat(){
            if (session()->has('bearer')) {
                return view('exam.starter.instruction-pusat');
            } else {
                return redirect()->route('login.show');
            }
        }

        public function show_instruction_daerah(){
            if (session()->has('bearer')) {
                return view('exam.starter.instruction-daerah');
            } else {
                return redirect()->route('login.show');
            }
        }

        public function start_exam(Request $request){
            if (session()->has('bearer')) {
                if (session()->has('on_exam')) {
                    return redirect()->route('exam.progress', 1);
                } else {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/session/'.$request->exam_type.'/'.session('user'));
                    $response = json_decode($apiResponse->body());
                    session(['on_exam' => $response->data->session_id]);
                    session(['exam_session' => 1]);
                    return redirect()->route('exam.session1.show',1);
                }
            } else {
                return redirect()->route('login.show');
            }
        }
    // End of Exam Starter Pack Functions

    // Session 1 Functions
        public function show_first_session($page){
            if (session()->has('bearer')) {
                if (session()->has('on_exam')) {
                    $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/'.session('on_exam').'?page='.$page);
                    $response1 = json_decode($apiResponse1->body());
                    $content = $response1->data;
    
                    $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/answer/'.session('on_exam'));
                    $response2 = json_decode($apiResponse2->body());
                    $answer = $response2->data;
                    return view('exam.session-1.multiple-choice', compact('content', 'answer'));
                } else {
                    return redirect()->route('exam.type');
                }
            } else {
                return redirect()->route('login.show');
            }   
        }

        public function save_first_session(Request $request){
            if ($request->save) {
                if ($request->{$request->current_page} != null) {
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/multiple-choice/answer/'.session('on_exam'),[
                        'answer_'.$request->current_page => $request->{$request->current_page},
                    ]);
                }
                return redirect()->route('exam.session1.show', $request->save);
            } 
            if ($request->submit) {
                $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/session-1/end/'.session('on_exam'), [
                    'answer_'.$request->current_page => $request->{$request->current_page},
                ]);
                $response = json_decode($apiResponse->body());
                $content = $response->data;
                session()->forget('exam_session');
                session(['exam_session' => 2]);
                return view('exam.session-1.interlude', compact('content'));
            }
        }
    // End of Session 1 Functions

    // Session 2 Functions
        public function show_second_session($page){
            if (session()->has('bearer')) {
                if (session()->has('on_exam')) {
                    $essayAnswerRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/answer/'.session('on_exam'));
                    $essayAnswerJSON = json_decode($essayAnswerRaw->body());
                    $essayAnswer = $essayAnswerJSON->data;

                    $csAnswerRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/answer/'.session('on_exam'));
                    $csAnswerJSON = json_decode($csAnswerRaw->body());
                    $caseStudyAnswer = $csAnswerJSON->data;
                    if ($page <= 5) {
                        $essayRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/'.session('on_exam').'?page='.$page);
                        $essayJSON = json_decode($essayRaw->body());
                        $question = $essayJSON->data;

                        $csRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.session('on_exam'));
                        $csJSON = json_decode($csRaw->body());
                        $caseStudyCount = ($csJSON->data)->instruction_count;
                        return view('exam.session-2.essay', compact('question', 'caseStudyCount', 'essayAnswer', 'caseStudyAnswer'));
                    } else {
                        $csRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.session('on_exam'));
                        $csJSON = json_decode($csRaw->body());
                        $caseStudyCount = ($csJSON->data)->instruction_count;
                        $question = $csJSON->data;
                        return view('exam.session-2.case-study', compact('question', 'essayAnswer', 'caseStudyAnswer'));
                    }
                } else {
                    return redirect()->route('exam.type');
                }
            } else {
                return redirect()->route('login.show');
            }  
        }

        public function save_second_session(Request $request){
            if (session()->has('bearer')) {
                if (session()->has('on_exam')) {
                    if ($request->essay) {
                        $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/essay/answer/'.session('on_exam'),[
                            'answer_'.$request->current_page => $request->answer,
                        ]);
                        $page = $request->current_page;
                        return redirect()->route('exam.session2.show', $page)->with('message', 'Jawaban tersimpan!');
                    }

                    if ($request->case_study) {
                        $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/case-study/answer/'.session('on_exam'),[
                            'answer_'.$request->case_study => $request->{"answer_$request->case_study"},
                        ]);
                        return redirect()->route('exam.session2.show', "caseStudy")->with('message', 'Jawaban tersimpan!');
                    }
                } else {
                    return redirect()->route('exam.type');
                }
            } else {
                return redirect()->route('login.show');
            } 
        }
    // End of Session 2 Functions

    // Exam Review Pack Functions
        public function end_exam(Request $request){
            if (session()->has('bearer')) {
                if (session()->has('on_exam')) {
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/session-2/end/'.session('on_exam'));
                    $response = json_decode($apiResponse->body());
                    $result = $response->data;
                    session()->forget('on_exam');
                    session()->forget('exam_session');
                    return redirect()->route('exam.result', $result->id);
                } else {
                    return redirect()->route('exam.type');
                }
            } else {
                return redirect()->route('login.show');
            } 
        }

        public function show_exam_result($session_id){
            if (session()->has('bearer')) {
                if (session()->missing('on_exam') && session()->missing('exam_session')) {
                    $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                    $response = json_decode($apiResponse->body());
                    $result = $response->data;
                    return view('exam.review.overview', compact('result'));
                } else {
                    if (session('exam_session') == 1) {
                        return redirect()->route('exam.session1.show', 1);
                    } else {
                        return redirect()->route('exam.session2.show', 1);
                    }
                }
            } else {
                return redirect()->route('login.show');
            } 
        }

        public function show_exam_mp_review($session_id, $page){
            if (session()->has('bearer')) {
                if (session()->missing('on_exam')) {
                    $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/'.$session_id.'?page='.$page);
                    $response1 = json_decode($apiResponse1->body());
                    $content = $response1->data;
           
                    $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/multiple-choice/'.$session_id);
                    $response2 = json_decode($apiResponse2->body());
                    $answer = $response2->data->answer;
                    $correct_answer = $response2->data->correct_answer;
                    return view('exam.review.multiple-choice', compact('content', 'answer', 'correct_answer', 'session_id'));
                } else {
                    if (session('exam_session') == 1) {
                        return redirect()->route('exam.session1.show', 1);
                    } else {
                        return redirect()->route('exam.session2.show', 1);
                    }
                }
            } else {
                return redirect()->route('login.show');
            } 
        }

        public function show_exam_ey_review($session_id, $page){
            if (session()->has('bearer')) {
                if (session()->missing('on_exam')) {
                    $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/'.$session_id.'?page='.$page);
                    $response1 = json_decode($apiResponse1->body());
                    $content = $response1->data;
           
                    $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/answer/'.$session_id);
                    $response2 = json_decode($apiResponse2->body());
                    $answer = $response2->data;
                    return view('exam.review.essay', compact('content', 'answer', 'session_id'));
                } else {
                    if (session('exam_session') == 1) {
                        return redirect()->route('exam.session1.show', 1);
                    } else {
                        return redirect()->route('exam.session2.show', 1);
                    }
                }
            } else {
                return redirect()->route('login.show');
            } 
        }

        public function show_exam_cs_review($session_id){
            if (session()->has('bearer')) {
                if (session()->missing('on_exam')) {
                    $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.$session_id);
                    $response1 = json_decode($apiResponse1->body());
                    $content = $response1->data;
           
                    $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/answer/'.$session_id);
                    $response2 = json_decode($apiResponse2->body());
                    $answer = $response2->data;
                    return view('exam.review.case-study', compact('content', 'answer', 'session_id'));
                } else {
                    if (session('exam_session') == 1) {
                        return redirect()->route('exam.session1.show', 1);
                    } else {
                        return redirect()->route('exam.session2.show', 1);
                    }
                }
            } else {
                return redirect()->route('login.show');
            } 
        }
    // End of Exam Review Pack Functions
}
