<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

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

        if(!Session::has('client')){

            return view('client.login');
        }

        if(!Session::has('cart')){

            return view('client.cart');
        }
        
        return view('client.checkout');
    }


    public function payer(Request $request){

        if(!Session::has('cart')){

            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;

        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51J1zXbEYCaqI8yeWg7cqnSCx9k9baHrTwG5AG1btiBUDXaimOwURc8lJPr9b6aK0XwYKuUI6XuuCIjfWUpgpTu1B00G4UEXBPt');

        try{

            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

          $order = new Order();

          $order->nom = $request->input('name');
          $order->adresse = $request->input('address');
          $order->panier = serialize($cart);
          $order->paiement_id = $charge->id;

          $order->save();


        } catch(\Exception $e){

            Session::put('error', $e->getMessage());

            return redirect('/paiement');
            
        }

        Session::forget('cart');

        Session::put('success', 'Purchase accomplished successfully !');

        return redirect('/panier')->with('status', 'Achat effectue avec succes');

    }


    public function creer_compte(Request $request){

        $this->validate($request, [
            'email' => 'email|required|unique:clients',
            'password' => 'required |min:4'
            ]
        );

        $client = new CLient();

        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Votre compte a ete cree avec succes');

    }


    public function acceder_compte(Request $request){

        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required |min:4'
            ]
        );

        $client = Client::where('email', $request->input('email'))->first();

        if ($client) {
            if (Hash::check($request->input('password'),  $client->password) ) {
                
                Session::put('client', $client);
                return redirect('/shop');

            } else {

                return back()->with('status', 'Mot de passe ou email incorrect');
            }
            
        } else {

            return back()->with('status', 'vous n\'avez pas de compte');
        }

    }


    public function logout(){

        Session::forget('client');

        return back();
    }


    public function client_login(){
        return view('client.login');
    }


    public function signup(){
        return view('client.signup');
    }

}
