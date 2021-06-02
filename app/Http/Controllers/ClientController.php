<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;

class ClientController extends Controller
{
    //
    public function home(){

        $sliders = Slider::where('status', 1)->get();

        $products = Product::where('status', 1)->get();

        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }

    public function shop(){

        $sliders = Slider::where('status', 1)->get();

        $products = Product::where('status', 1)->get();

        $categories = Category::get();

        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function select_par_cat($name){

        $categories = Category::get();
        
        $products = Product::where('product_category', $name)->where('status', 1)->get();

        return view('client.shop')->with('products', $products)->with('categories', $categories);

    }

    public function ajouter_au_panier($id){

        $product = Product::find($id);
    }

    public function panier(){
        return view('client.cart');
    }


    public function paiement(){
        return view('client.checkout');
    }


    public function client_login(){
        return view('client.login');
    }


    public function signup(){
        return view('client.signup');
    }

}
