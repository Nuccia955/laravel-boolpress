<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        Mail::to(Auth::user()->email)->send(new SendEmail(Auth::user()->name));
        return view('admin.home');
    }
}
