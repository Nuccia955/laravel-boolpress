<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class HomeController extends Controller
{
    public function index() {
        Mail::to('cicciopasticcio@test.com')->send(new SendEmail());
        return view('admin.home');
    }
}
