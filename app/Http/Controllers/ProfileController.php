<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);
        $oldPhoto = $user->photo_profile;
        // dd($oldPhoto);
        $validateData = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|email:dns|unique:users,email,' . Auth::user()->id,
            'photo_profile' => 'file|image|mimes:jpg,jpeg,png|max:50000'
        ]);

        if ($request->photo_profile == null) {
            $validateData['photo_profile'] = $oldPhoto;
        }

        if ($request->photo_profile != null) {
            if ($oldPhoto != null) {
                if (file_exists($oldPhoto)) {
                    unlink(public_path($oldPhoto));
                }
            }
            $foto = $request->file('photo_profile');
            $name = $foto->hashName();
            $validateData['photo_profile'] = 'photo_profile/' . $name;
            $foto->move(public_path('/photo_profile'), $name);
        }
        $user->update($validateData);
        return redirect(route('profile.index'))->with('success', "Berhasil merubah data profile");
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:5|max:255'
        ]);
        $user = $request->user();
        if (!(Hash::check($request->current_password, $user->password))) {
            return back()->withErrors(['current_password' => 'Your recent password is incorrect.']);
        }
        $password = Hash::make($request->password);
        $user->update(['password' => $password]);
        return redirect()->back()->with('success', 'Password Updated');
    }
}
