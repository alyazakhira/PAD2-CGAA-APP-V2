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
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/session/'.$request->exam_type.'/'.session('user'));
                $response = json_decode($apiResponse->body());
                return redirect()->route('exam.session1.show', ['session_id'=>$response->data->session_id, 'page'=>1]);
            } else {
                return redirect()->route('login.show');
            }
        }

        public function show_interlude($session_id){ // [NOT FINISHED YET]
            if (session()->has('bearer')) {
                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                $sessionData = json_decode($sessionDataRaw->body());
                $content = $sessionData->data;
                return view('exam.starter.interlude', compact('content','session_id'));
            } else {
                return redirect()->route('login.show');
            }
        }
    // End of Exam Starter Pack Functions

    // Session 1 Functions
        public function show_first_session($session_id, $page){
            if (session()->has('bearer')) {
                $questionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/'.$session_id.'?page='.$page);
                $questionData = json_decode($questionDataRaw->body());
                $content = $questionData->data;

                $answerDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/answer/'.$session_id);
                $answerData = json_decode($answerDataRaw->body());
                $answer = $answerData->data;
                return view('exam.session-1.multiple-choice', compact('content', 'answer', 'session_id'));
            } else {
                return redirect()->route('login.show');
            }   
        }

        public function save_first_session(Request $request, $session_id){
            if ($request->save) {
                if ($request->{$request->current_page} != null) {
                    $saveAnswer = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/multiple-choice/answer/'.$session_id,[
                        'answer_'.$request->current_page => $request->{$request->current_page},
                    ]);
                }
                return redirect()->route('exam.session1.show', ['session_id'=>$session_id, 'page'=>$request->save]);
            } 
            if ($request->submit) {
                $saveAnswer = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/multiple-choice/answer/'.$session_id,[
                    'answer_'.$request->current_page => $request->{$request->current_page},
                ]);
                $submitAnswer = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/session-1/end/'.$session_id);
                $response = json_decode($submitAnswer->body());
                $content = $response->data;
                return redirect()->route('exam.interlude', $session_id);;
            }
        }
    // End of Session 1 Functions

    // Session 2 Functions
        public function show_second_session($session_id, $page){
            if (session()->has('bearer')) {
                $essayAnswerRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/answer/'.$session_id);
                $essayAnswerJSON = json_decode($essayAnswerRaw->body());
                $essayAnswer = $essayAnswerJSON->data;

                $csAnswerRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/answer/'.$session_id);
                $csAnswerJSON = json_decode($csAnswerRaw->body());
                $caseStudyAnswer = $csAnswerJSON->data;
                if ($page <= 5) {
                    $essayRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/'.$session_id.'?page='.$page);
                    $essayJSON = json_decode($essayRaw->body());
                    $question = $essayJSON->data;

                    $csRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.$session_id);
                    $csJSON = json_decode($csRaw->body());
                    $caseStudyCount = ($csJSON->data)->instruction_count;
                    return view('exam.session-2.essay', compact('question', 'caseStudyCount', 'essayAnswer', 'caseStudyAnswer', 'session_id'));
                } else {
                    $csRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.$session_id);
                    $csJSON = json_decode($csRaw->body());
                    $caseStudyCount = ($csJSON->data)->instruction_count;
                    $question = $csJSON->data;
                    return view('exam.session-2.case-study', compact('question', 'essayAnswer', 'caseStudyAnswer', 'session_id'));
                }
            } else {
                return redirect()->route('login.show');
            }  
        }

        public function save_second_session(Request $request, $session_id){
            if (session()->has('bearer')) {
                if ($request->essay) {
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/essay/answer/'.$session_id,[
                        'answer_'.$request->current_page => $request->answer,
                    ]);
                    $page = $request->current_page;
                    return redirect()->route('exam.session2.show', ['session_id'=>$session_id, 'page'=>$page])->with('message', 'Jawaban tersimpan!');
                }

                if ($request->case_study) {
                    $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/case-study/answer/'.$session_id,[
                        'answer_'.$request->case_study => $request->{"answer_$request->case_study"},
                    ]);
                    return redirect()->route('exam.session2.show', ['session_id'=>$session_id, 'page'=>"caseStudy"])->with('message', 'Jawaban tersimpan!');
                }
            } else {
                return redirect()->route('login.show');
            } 
        }
    // End of Session 2 Functions

    // Exam Review Pack Functions
        public function end_exam(Request $request, $session_id){
            if (session()->has('bearer')) {
                $resultDataRaw = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/exam/session-2/end/'.$session_id);
                $resultData = json_decode($resultDataRaw->body());
                $result = $resultData->data;
                return redirect()->route('exam.result', $result->id);
            } else {
                return redirect()->route('login.show');
            } 
        }

        public function show_exam_result($session_id){
            if (session()->has('bearer')) {
                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                $sessionData = json_decode($sessionDataRaw->body());
                $session = $sessionData->data;
                if ($session->status == 0) {
                    $result = $session;
                    return view('exam.review.overview', compact('result'));
                } else {
                    if ($session->status == 1) {
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
                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                $sessionData = json_decode($sessionDataRaw->body());
                $session = $sessionData->data;
                if ($session->status == 0) {
                    $questionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/multiple-choice/'.$session_id.'?page='.$page);
                    $questionData = json_decode($questionDataRaw->body());
                    $content = $questionData->data;
           
                    $answerDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/result/multiple-choice/'.$session_id);
                    $answerData = json_decode($answerDataRaw->body());
                    $answer = $answerData->data->answer;
                    $correct_answer = $answerData->data->correct_answer;
                    return view('exam.review.multiple-choice', compact('content', 'answer', 'correct_answer', 'session_id'));
                } else {
                    if ($session->status == 1) {
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
                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                $sessionData = json_decode($sessionDataRaw->body());
                $session = $sessionData->data;
                if ($session->status == 0) {
                    $questionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/'.$session_id.'?page='.$page);
                    $questionData = json_decode($questionDataRaw->body());
                    $content = $questionData->data;
           
                    $answerDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/essay/answer/'.$session_id);
                    $answerData = json_decode($answerDataRaw->body());
                    $answer = $answerData->data;
                    return view('exam.review.essay', compact('content', 'answer', 'session_id'));
                } else {
                    if ($session->status == 1) {
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
                $sessionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
                $sessionData = json_decode($sessionDataRaw->body());
                $session = $sessionData->data;
                if ($session->status == 0) {
                    $questionDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/'.$session_id);
                    $questionData = json_decode($questionDataRaw->body());
                    $content = $questionData->data;
           
                    $answerDataRaw = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam/case-study/answer/'.$session_id);
                    $answerData = json_decode($answerDataRaw->body());
                    $answer = $answerData->data;
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
