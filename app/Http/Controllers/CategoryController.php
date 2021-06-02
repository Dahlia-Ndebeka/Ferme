<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function ajoutercategorie(){

        return view('admin.ajoutercategorie');
    }

    public function sauvercategorie(Request $request){
        
        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $categorie = new Category();

        $categorie->category_name = $request->input('category_name');

        $categorie->save();

        return redirect('/ajoutercategorie')->with('status', 'La categorie ' .$categorie->category_name . ' a ete ajoutee avec succes' );
    }

    public function categories(){

        $categories = Category::all();

        return view('admin.categories')->with('categories', $categories);
    }

    public function edit_categorie($id){

        $categorie = Category::Find($id);

        return view('admin.editcategorie')->with('categorie', $categorie);
    }

    public function modifiercategorie(Request $request){

        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $categorie = Category::find($request->input('id'));

        $categorie->category_name = $request->input('category_name');

        $categorie->update();

        return redirect('/categories')->with('status', 'La categorie ' .$categorie->category_name . ' a ete modifiee avec succes' );
    }

    public function supprimercategorie($id){

        $categorie = Category::Find($id);

        $categorie->delete();

        return redirect('/categories')->with('status', 'La categorie ' .$categorie->category_name . ' a ete supprimee avec succes' );
    }

}
