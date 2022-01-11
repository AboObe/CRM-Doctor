<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->status == 'active')
        {
         switch(Auth::user()->admin){
                case 1:
                    return view('home');
                    break;
                default:
                    Auth::logout();
                    return redirect()->route('/')->with('error','you can not login');
	       }
        }
        else
        {
            Auth::logout();
            return redirect()->route('/')->with('error','you can not login');

        }
    }
}
