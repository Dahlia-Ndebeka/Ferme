<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Session;

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

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return redirect('/shop');
    }

    public function panier(){

        if(!Session::has('cart')){

            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;

        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items]);
    }


    public function modifier_panier(Request $request, $id){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect('/panier');
    }


    public function retirer_produit($id){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect('/panier');


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
