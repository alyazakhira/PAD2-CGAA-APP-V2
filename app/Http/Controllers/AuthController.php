<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function signin(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-in');
        }
    }

    public function signup(){
        if (session()->has('bearer')) {
            if (session('authorized')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return view('sign-up');
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $apiResponse = Http::post('http://localhost:8000/api/v2/login',[
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $response = json_decode($apiResponse->body());

        if ($response->success) {
            session(['bearer' => $response->data->access_token]);
            session(['user' => $response->data->id]);
            if ($response->data->admin) {
                session(['authorized' => true]);
                return redirect()->route('admin.dashboard');
            } else {
                session(['authorized' => false]);
                return redirect()->route('user.dashboard');
            }
        } else {
            return back()->withErrors($response->message)->onlyInput('email');
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'occupation_type' => 'required',
            'institution' => 'required',
            'occupation' => Rule::requiredIf($request->occupation_type == "non-mahasiswa"),
            'generation' => Rule::requiredIf($request->occupation_type == "mahasiswa"),
            'study_program' => Rule::requiredIf($request->occupation_type == "mahasiswa"),
            'email' => 'required|email',
            'password' => 'required',
            
        ]);
        if ($request->occupation_type == "mahasiswa") {
            $apiResponse = Http::post('http://localhost:8000/api/v2/register',[
                'name' => $request->name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'occupation' => "Mahasiswa",
                'institution' => $request->institution,
                'generation' => $request->generation,
                'study_program' => $request->study_program,
                'email' => $request->email,
                'password' => $request->password,
                'is_admin' => 0,
            ]);
        } else {
            $apiResponse = Http::post('http://localhost:8000/api/v2/register',[
                'name' => $request->name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'occupation' => $request->occupation,
                'institution' => $request->institution,
                'generation' => null,
                'study_program' => null,
                'email' => $request->email,
                'password' => $request->password,
                'is_admin' => 0,
            ]);
        }

        $response = json_decode($apiResponse->body());
        return redirect()->route('login.show');
    }

    public function logout(Request $request){
        if ($request->session()->exists('bearer')) {
            $apiResponse = Http::withToken(session('bearer'))->post('http://localhost:8000/api/v1/logout');
            $request->session()->flush();
            return redirect('/');
        } else {
            $request->session()->flush();
            return redirect('/');
        }
    }

    public function input_email(){
        return Http::get('http://localhost:8000/api/v2/forget-password');
    }
}
