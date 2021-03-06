<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;


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
    public function index(Request $request)
    {
        return view('home');   
    }

    /** obsolute */
    public function extToken(Request $request){
        $user = auth()->user();
        $access_token = $user->createToken( $request->device_name ?? ($request->ip() ?? "Unknown") )->plainTextToken;
        return  'jsonstart'. json_encode([ 
            "access_token"=>$access_token,
            "token_type"=>"Bearer"
        ]) . 'jsonstop';
       
    }
}
