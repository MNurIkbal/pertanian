<?php

namespace App\Http\Controllers;

use App\Models\KomentarInformasi;
use App\Http\Requests\StoreKomentarInformasiRequest;
use App\Http\Requests\UpdateKomentarInformasiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarInformasiController extends Controller
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
     * @param  \App\Http\Requests\StoreKomentarInformasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validatedRequest =  $request->validate([
            'content' => 'required|min:10',
        ]);
        $validatedRequest['user_id'] = Auth::user()->id;
        $validatedRequest['informasi_id'] = (int)$id;

        KomentarInformasi::create($validatedRequest);
        return redirect()->back();
    }
    public function storeKomentar(Request $request, $informasi_id, $komentar_id)
    {
        $validatedRequest =  $request->validate([
            'content2' => 'required|min:10',
        ]);
        $data = [];
        $data['content'] = $validatedRequest['content2'];
        $data['user_id'] = Auth::user()->id;
        $data['informasi_id'] = (int)$informasi_id;
        $data['komentar_informasi_id'] = (int)$komentar_id;

        KomentarInformasi::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KomentarInformasi  $komentarInformasi
     * @return \Illuminate\Http\Response
     */
    public function show(KomentarInformasi $komentarInformasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KomentarInformasi  $komentarInformasi
     * @return \Illuminate\Http\Response
     */
    public function edit(KomentarInformasi $komentarInformasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKomentarInformasiRequest  $request
     * @param  \App\Models\KomentarInformasi  $komentarInformasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KomentarInformasi $id)
    {
        // dd($request->all());
        // dd($id);
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
     * @param  \App\Models\KomentarInformasi  $komentarInformasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomentarInformasi $komentarInformasi)
    {
        //
    }
}