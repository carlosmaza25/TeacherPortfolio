<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Models\CycleDetail;
use App\Models\SocialProfile;

class LoginController extends Controller
{
    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback() {
        $socialUser = Socialite::driver('google')->stateless()->user();
        $user = Teacher::where('email' , $socialUser->getEmail())->first();
        $cycleid = CycleDetail::orderBy('cycledetailid' , 'desc')->first();        

        if($user) {

            $teacher = $user->name . ' ' . $user->lastname;

            $teacherprofile = SocialProfile::updateOrCreate([
                'socialid' => $socialUser->id,
            ], [
                'teacherid' => $user->teacherid,
                'socialid' => $socialUser->id,
                'socialavatar' => $socialUser->avatar,
            ]);
    
            Auth::login($user);

           session([
            'id' => $user->teacherid,
            'name' => $teacher,
            'usertype' => $user->userid,
            'cycleid' => $cycleid,
           ]);
    
           return redirect()->route('home.index' , ['cycleid' => $cycleid]) ;

        }else {
            return redirect()->route('login')->with('alert' , 'el correo no se ha registrado, debe loguearse con su correo institucional, si no puede entrar debe solicitar ayuda tecnica.');
        }
    }
}
