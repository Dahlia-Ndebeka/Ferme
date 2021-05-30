<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function ajoutercategorie(){
        return view('admin.ajoutercategorie');
    }

    public function sauvercategorie(Request $request){
        // return view('admin.ajoutercategorie');
    }

    public function categories(){
        return view('admin.categories');
    }

}
