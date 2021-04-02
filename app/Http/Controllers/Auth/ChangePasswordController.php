<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\{Auth, Hash};

class ChangePasswordController extends Controller
{
    public function index(){
        return view('auth.change-password');
    }

    public function store(ChangePasswordRequest $request){
        $inputPassword = $request->old_password;

        if ( Hash::check($inputPassword, auth()->user()->password) ) {
            auth()->user()->update([
                'password'=>bcrypt($request->password)
            ]);

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login')->with('status', 'The password has been successfully changed.');
        }

        return redirect()->back()->withErrors(['old_password'=>'The old password is incorrect.']);
        
    }
}
