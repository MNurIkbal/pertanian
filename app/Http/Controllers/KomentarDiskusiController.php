<?php

namespace App\Http\Controllers;

use App\Models\KomentarDiskusi;
use App\Http\Requests\StoreKomentarDiskusiRequest;
use App\Http\Requests\UpdateKomentarDiskusiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarDiskusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKomentarDiskusiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validatedRequest =  $request->validate([
            'content' => 'required|min:10',
        ]);
        $validatedRequest['user_id'] = Auth::user()->id;
        $validatedRequest['diskusi_id'] = (int)$id;

        KomentarDiskusi::create($validatedRequest);
        return redirect()->back();
    }
    public function storeKomentar(Request $request, $diskusi_id, $komentar_id)
    {
        $validatedRequest =  $request->validate([
            'content2' => 'required|min:10',
        ]);
        $data = [];
        $data['content'] = $validatedRequest['content2'];
        $data['user_id'] = Auth::user()->id;
        $data['diskusi_id'] = (int)$diskusi_id;
        $data['komentar_diskusi_id'] = (int)$komentar_id;

        KomentarDiskusi::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KomentarDiskusi  $komentarDiskusi
     * @return \Illuminate\Http\Response
     */
    public function show(KomentarDiskusi $komentarDiskusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KomentarDiskusi  $komentarDiskusi
     * @return \Illuminate\Http\Response
     */
    public function edit(KomentarDiskusi $komentarDiskusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKomentarDiskusiRequest  $request
     * @param  \App\Models\KomentarDiskusi  $komentarDiskusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KomentarDiskusi $id)
    {
        $validatedRequest =  $request->validate([
            'content_update' => 'required|min:10',
        ]);
        $data['content'] = $validatedRequest['content_update'];
        $id->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KomentarDiskusi  $komentarDiskusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomentarDiskusi $komentarDiskusi)
    {
        //
    }
}
