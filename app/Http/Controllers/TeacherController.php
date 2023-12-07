<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialProfile;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public $messages ;
    
    public function index($id) {
        session(['teachertoupdate' => $id]);
        $plantilla = '' ;
        $name = session('name');
        $socialProfile =  SocialProfile::where('teacherid' , session('id'))->first() ;
        $avatarteacher = SocialProfile::where('teacherid' , $id)->first() ;
        $datesuser = Teacher::where('teacherid' , $id)->first();

        if (session('usertype') == 1) {
            $plantilla = true;
        }
        else {
            $plantilla = false ;
        }

        return view('Teacher.profileTeacher' , compact('name' , 'socialProfile' , 'datesuser' , 'plantilla' , 'avatarteacher'));
    }

    public function update (Request $request) {
        $names = '' ; 
        $lastnames = '' ;
        $cellphone = '' ;
        $universityid = '' ;
        $email = '' ;
        $teachertoupdate = Teacher::find(session('teachertoupdate'));

        if (empty($request->input('names'))){
            $names = $teachertoupdate->name;
        }
        else {
            $names = $request->input('names');
        }
        if (empty($request->input('lastnames'))) {
            $lastnames = $teachertoupdate->lastname;
        }
        else {
            $lastnames = $request->input('lastnames');
        }
        if (empty($request->input('phone'))) {
            $cellphone = $teachertoupdate->cellphonenumber ;
        }
        else {
            $cellphone = $request->input('phone');
        }
        if (empty($request->input('universityid'))) {
            $universityid = $teachertoupdate->universityid ;
        }
        else {
            $universityid = $request->input('universityid');
        }
        if (empty($request->input('email'))) {
            $email = $teachertoupdate->email ;
        }
        else {
            $email = $request->input('email') ;
        }

        if (!preg_match('/^[0-9-]*$/' , $cellphone)){
            $this->messages = 'el numero de celular solo puede contenter numeros y opcionalmente guiones' ;
            return redirect()->back()->with('cellphone' , $this->messages)->withInput();
        }
        else if (!preg_match('/^[a-zA-Z\s]+$/' , $names)) {
            $this->messages = 'El nombre del docente solo puede contener letras.' ;
            return redirect()->back()->with('namevalidation' , $this->messages)->withInput();
        }
        else if (!preg_match('/^[a-zA-Z\s]+$/' , $lastnames)) {
            $this->messages = 'El apellido del docente solo puede contener letras.' ;
            return redirect()->back()->with('lastname' , $this->messages)->withInput();
        }

        else {

            $teachertoupdate->name = $names ;
            $teachertoupdate->lastname = $lastnames ;
            $teachertoupdate->cellphonenumber = $cellphone ;
            $teachertoupdate->universityid = $universityid ;
            $teachertoupdate->email = $email ;
            $teachertoupdate->save() ;

        }
    }
}
