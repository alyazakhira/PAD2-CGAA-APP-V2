<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SimulationController extends Controller
{
    public function type_select(){
        if (session()->has('bearer')) {
            return view('exam.select-type');
        } else {
            return view('sign-in');
        }
    }

    public function instruction_pusat(){
        if (session()->has('bearer')) {
            return view('exam.instruction-pusat');
        } else {
            return view('sign-in');
        }
    }

    public function instruction_daerah(){
        if (session()->has('bearer')) {
            return view('exam.instruction-daerah');
        } else {
            return view('sign-in');
        }
    }

    public function start_exam(Request $request){
        if (session()->has('bearer')) {
            if (session()->has('on_exam')) {
                return redirect()->route('exam.progress', 1);
            } else {
                $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-'.$request->exam_type.'/'.session('user'));
                $response = json_decode($apiResponse->body());
                session(['on_exam' => $response->data->session_id]);
                return redirect()->route('exam.progress',1);
            }
        } else {
            return view('sign-in');
        }
    }

    public function exam_data($page){
        if (session()->has('bearer')) {
            if (session()->has('on_exam')) {
                $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-data/'.session('on_exam').'?page='.$page);
                $response1 = json_decode($apiResponse1->body());
                $content = $response1->data;

                $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/session-answer/'.session('on_exam'));
                $response2 = json_decode($apiResponse2->body());
                $answer = $response2->data;
                return view('exam.exam-page', compact('content', 'answer'));
            } else {
                return view('exam.select-type');
            }
        } else {
            return view('sign-in');
        }
    }

    public function save_or_submit(Request $request){
        if ($request->save) {
            if ($request->{$request->current_page} != null) {
                $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/save-answer/'.session('on_exam'),[
                    'answer_'.$request->current_page => $request->{$request->current_page},
                ]);
            }
            return redirect()->route('exam.progress', $request->save);
        } 
        if ($request->submit) {
            $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v2/calculate-score/'.session('on_exam'), [
                'answer_'.$request->current_page => $request->{$request->current_page},
            ]);
            $response = json_decode($apiResponse->body());
            $result = $response->data;
            session()->forget('on_exam');
            return redirect()->route('exam.result', $result->id);
        }
    }

    public function exam_result($session_id){
        if (session()->missing('on_exam')) {
            $apiResponse = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-session/'.$session_id);
            $response = json_decode($apiResponse->body());
            $result = $response->data;
            $score = $result->score;
            return view('exam.exam-result', compact('result', 'score'));
        } else {
            return redirect()->route('exam.progress', 1);
        }
    }

    public function exam_explanation($session_id, $page){
        if (session()->missing('on_exam')) {
            $apiResponse1 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/exam-data/'.$session_id.'?page='.$page);
            $response1 = json_decode($apiResponse1->body());
            $content = $response1->data;
   
            $apiResponse2 = Http::withToken(session('bearer'))->get('http://localhost:8000/api/v2/session-answer-key/'.$session_id);
            $response2 = json_decode($apiResponse2->body());
            $answer = $response2->data->answer;
            $correct_answer = $response2->data->correct_answer;
            return view('exam.explanation-page', compact('content', 'answer', 'correct_answer'));
        } else {
            return redirect()->route('exam.progress', 1);
        }
        
    }
}
