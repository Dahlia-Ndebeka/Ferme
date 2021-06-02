<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    //

    public function ajouterslider(){
        return view('admin.ajouterslider');
    }

    public function sauverslider(Request $request){
        
        $this->validate($request, [
            'description1' => 'required',
            'description2' => 'required',
            'slider_image' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('slider_image')) {

            // 1 : Prendre le nom du fichier avec son extension
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

            // 2 : Prendre juste le nom du fichier
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : Prendre juste l'extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // 4 : Prendre le nom que nous allons sauvegarder dans la base de donnees
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // 5 : Sauvegarder l'image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);


        } else {
            
            $fileNameToStore = 'noimage.jpg';
        }

        $slider = new Slider();

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->slider_image = $fileNameToStore;
        $slider->status = 1;

        $slider->save();

        return redirect('/ajouterslider')->with('status', 'Le slider  a ete ajoute avec succes');

    }

    public function sliders(){

        $sliders = Slider::all();

        return view('admin.sliders')->with('sliders' , $sliders);
    }

    public function edit_slider($id){

        $slider = Slider::find($id);

        return view('/admin.editslider')->with('slider', $slider);

    }

    public function modifierslider(Request $request){

        $this->validate($request, [
            'description1' => 'required',
            'description2' => 'required',
            'slider_image' => 'image|nullable|max:1999',
        ]);

        $slider = Slider::find($request->input('id'));

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');

        if ($request->hasFile('slider_image')) {

            // 1 : Prendre le nom du fichier avec son extension
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

            // 2 : Prendre juste le nom du fichier
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : Prendre juste l'extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // 4 : Prendre le nom que nous allons sauvegarder dans la base de donnees
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // 5 : Sauvegarder l'image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);


            if ($slider->slider_image != 'noimage.jpg') {
                
                Storage::delete('public/slider_images/'.$slider->slider_image);
            }

            $slider->slider_image = $fileNameToStore;

        }

        $slider->update();
        
        return redirect('/sliders')->with('status', 'Le slider  a ete modifie avec succes');

    }

    public function supprimerslider($id){

        $slider = Slider::find($id);

        if ($slider->slider_image != 'noimage.jpg') {
                
            Storage::delete('public/slider_images/'.$slider->slider_image);
        }

        $slider->delete();

        return redirect('/sliders')->with('status', 'Le slider a ete supprime avec succes');

    }

    public function activer_slider($id){

        $slider = Slider::find($id);

        $slider->status = 1;

        $slider->update();

        return redirect('/sliders')->with('status', 'Le slider a ete active avec succes');
        
    }

    public function desactiver_slider($id){

        $slider = Slider::find($id);

        $slider->status = 0;

        $slider->update();

        return redirect('/sliders')->with('status', 'Le slider a ete desactive avec succes');
        
    }

}
