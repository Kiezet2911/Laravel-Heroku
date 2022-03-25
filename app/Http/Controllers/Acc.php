<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class Acc extends Controller
{

    function login(Request $req)
    {
        $tk = $req->input('username');
        $pass = $req->input('pass');
        if (isset($tk) && isset($pass)) {
            $data = Http::post('https://bookingapiiiii.herokuapp.com/login', [
                "Taikhoan" =>  $tk,
                "Matkhau" =>  $pass
            ]);
            $req->session()->put('UserLogin', $data);
            if (isset($data['id'])) {
                return Redirect('');
            } else {
                return view('signin', ['mess', $data['Messenger']]);
            }
        }
    }

    function signup(Request $req)
    {
        $fullname = $req->input('fullname');
        $tk = $req->input('username');
        $pass = $req->input('pass');
        $compass = $req->input('compass');
        if (isset($tk) && isset($pass) && isset($compass) && isset($fullname)) {
            $data = Http::post('https://bookingapiiiii.herokuapp.com/khachhang', [
                "HoTen" => $fullname,
                "Taikhoan" =>  $tk,
                "Matkhau" =>  $pass,
                "ConfirmMatKhau" => $compass
            ]);
            $req->session()->put('UserLogin', $data);
            if (isset($data['id'])) {
                return Redirect('');
            }
            return view('signup');
        }
    }
}
