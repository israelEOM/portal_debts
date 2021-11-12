<?php
namespace App\Http\Controllers\Portal\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Services\ReCaptcha\ReCaptchaService;

class HomeController extends Controller
{
    public function index()
    {
        return view("portal.home");
    }
}