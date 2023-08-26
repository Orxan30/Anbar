<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class langController extends Controller
{
    public function index(){

        return view('lang');
      
    }



    public function change(Request $request){

            App::setlocale($request->lang);
            session()->put('locale',$request->lang);
            return redirect()->back();
      
    }


}

