<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    //

    public function ajouterproduit(){

        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.ajouterproduit')->with('categories', $categories);
    }

    public function sauverproduit(Request $request){
        
        $this->validate($request, [
            'product_name' => 'required|unique:products',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('product_image')) {

            // 1 : Prendre le nom du fichier avec son extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

            // 2 : Prendre juste le nom du fichier
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : Prendre juste l'extension
            $extension = $request->file('product_image')->getClientOriginalExtension();

            // 4 : Prendre le nom que nous allons sauvegarder dans la base de donnees
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // 5 : Sauvegarder l'image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);


        } else {
            
            $fileNameToStore = 'noimage.jpg';
        }

        $product = new Product();

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
        $product->status = 1;

        $product->save();

        return redirect('/ajouterproduit')->with('status', 'Le produit '.$product->product_name.' a ete ajoute avec succes');

        
    }

    public function produits(){

        $produits = Product::all();

        return view('admin.produits')->with('produits' , $produits);
    }

    public function edit_produit($id){

        $product = Product::Find($id);

        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.editproduit')->with('product', $product)->with('categories', $categories);
    }

    public function modifierproduit(Request $request){

        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if ($request->hasFile('product_image')) {

            // 1 : Prendre le nom du fichier avec son extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

            // 2 : Prendre juste le nom du fichier
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : Prendre juste l'extension
            $extension = $request->file('product_image')->getClientOriginalExtension();

            // 4 : Prendre le nom que nous allons sauvegarder dans la base de donnees
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // 5 : Sauvegarder l'image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);


            if ($product->product_image != 'noimage.jpg') {
                
                Storage::delete('public/product_images/'.$product->product_image);
            }

            $product->product_image = $fileNameToStore;

        }

        $product->update();
        
        return redirect('/produits')->with('status', 'Le produit '.$product->product_name.' a ete modifie avec succes');

    }

    public function supprimerproduit($id){

        $product = Product::find($id);

        if ($product->product_image != 'noimage.jpg') {
                
            Storage::delete('public/product_images/'.$product->product_image);
        }

        $product->delete();

        return redirect('/produits')->with('status', 'Le produit '.$product->product_name.' a ete supprime avec succes');

    }

    public function activer_produit($id){

        $product = Product::find($id);

        $product->status = 1;

        $product->update();

        return redirect('/produits')->with('status', 'Le produit '.$product->product_name.' a ete active avec succes');
        
    }

    public function desactiver_produit($id){

        $product = Product::find($id);

        $product->status = 0;

        $product->update();

        return redirect('/produits')->with('status', 'Le produit '.$product->product_name.' a ete desactive avec succes');
        
    }

}
