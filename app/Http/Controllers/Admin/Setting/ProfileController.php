<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Index');
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'min:8',
        ]);

        $user = Auth::user();
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with('error', 'Password lama salah');
        }

        User::where('id', $user->id)->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->route('profile.index');
    }
}
