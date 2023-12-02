<?php

namespace App\Http\Controllers;

use App\Models\SocialProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFile extends Controller
{
    public function documents() {
        $plantilla = false ;
        $name = session('name');
        $id = session('id');
        $socialProfile = SocialProfile::where('teacherid' , $id)->first();
        $files = Storage::disk('public')->files('uploads');
        
        if (session('usertype') === 1) {
            $plantilla = true ;
        }

        return view ('Documentos' , compact('plantilla' , 'name' , 'socialProfile' , 'files'));
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx',
        ]);

        $file = $request->file('file');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('uploads') , $filename);
        return back()->with('success' , 'Archivo subido correctamente..');
    }
}
