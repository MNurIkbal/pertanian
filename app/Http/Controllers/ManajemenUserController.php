<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        return view('dashboard.manajemen-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manajemen-user.create-petani');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|email:dns|unique:users,email',
            'password' => 'required|max:255|min:5|confirmed',
            'photo_profile' => 'file|image|mimes:jpg,jpeg,png|max:50000'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['role_id'] = 2;

        if ($request->photo_profile != null) {
            $foto = $request->file('photo_profile');
            $name = $foto->hashName();
            $validateData['photo_profile'] = 'photo_profile/' . $name;
            $foto->move(public_path('/photo_profile'), $name);
        }

        User::create($validateData);

        return redirect(route('manajemen-user.index'))->with('success', "Berhasil menambahkan akun petani");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decryptId = decrypt($id);
        $user = User::where('id', $decryptId)->first();

        return view('dashboard.manajemen-user.edit-petani', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $decryptId = decrypt($id);
        // dd($decryptId);
        $user = User::where('id', $decryptId)->first();
        // dd($user);
        $oldPhoto = $user->photo_profile;

        $validateData = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|email:dns|unique:users,email,' . $user->id,
            'password' => 'nullable|max:255|min:5|confirmed',
            'photo_profile' => 'file|image|mimes:jpg,jpeg,png|max:50000'
        ]);
        if ($request->password == null) {
            $validateData['password'] = $user->password;
        }

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
        return redirect(route('manajemen-user.index'))->with('success', "Berhasil merubah akun petani");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
