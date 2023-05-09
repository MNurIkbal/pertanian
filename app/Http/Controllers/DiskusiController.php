<?php

namespace App\Http\Controllers;

use App\Models\Diskusi;
use App\Http\Requests\StoreDiskusiRequest;
use App\Http\Requests\UpdateDiskusiRequest;
use App\Models\KomentarDiskusi;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DiskusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diskusi = Diskusi::orderBy('updated_at', 'desc')->paginate(8);

        if (request('search') != null) {
            $diskusi = Diskusi::query()
                ->join('users', 'diskusis.user_id', '=', 'users.id')
                ->where('users.name', 'like', '%' . request('search') . '%')
                ->orWhere('diskusis.judul', 'like', '%' . request('search') . '%')
                ->orderBy('diskusis.updated_at', 'desc')
                ->paginate(8);
        }

        return view('dashboard.diskusi.index-diskusi', compact('diskusi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.diskusi.create-diskusi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiskusiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|min:10|max:255',
            'content' => 'required'
        ]);
        $validateData['user_id'] = Auth::user()->id;

        Diskusi::create($validateData);

        return redirect(route('diskusi.index'))->with('success', 'Berhasil menambahkan diskusi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('diskusi.index'))->with('error', $e);
        }

        $diskusi = Diskusi::where('id', $decryptedId)->first();
        $komentars = KomentarDiskusi::where('diskusi_id', $diskusi->id)->whereNull('komentar_diskusi_id')->get();
        $nastedKomentar = KomentarDiskusi::where('diskusi_id', $diskusi->id)->whereNotNull('komentar_diskusi_id')->get();
        return view('dashboard.diskusi.show-diskusi', compact('diskusi', 'komentars', 'nastedKomentar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('diskusi.index'))->with('error', $e);
        }
        $diskusi = Diskusi::where('id', $decryptedId)->first();
        return view('dashboard.diskusi.edit-diskusi', compact('diskusi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiskusiRequest  $request
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'judul' => 'required|min:10|max:255',
            'content' => 'required'
        ]);

        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('diskusi.index'))->with('error', $e);
        }

        $diskusi = Diskusi::where('id', $decryptedId)->first();
        $diskusi->update($validateData);

        return redirect(route('diskusi.index'))->with('success', 'Berhasil merubah diskusi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskusi  $diskusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskusi $diskusi)
    {
        //
    }
}