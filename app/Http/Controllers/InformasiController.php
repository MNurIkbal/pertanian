<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\KomentarInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $informasi = Informasi::orderBy('id', 'desc')->paginate(8);
        if (request('search') != null) {
            $informasi = Informasi::where('judul', 'like', '%' . request('search') . '%')->paginate(8);
        }

        return view('dashboard.informasi.index-informasi', compact('informasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.informasi.create-informasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInformasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|min:3|max:255',
            'body' => 'required'
        ]);

        $storage = "foto-informasi/";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $data['body'] = $dom->saveHTML();
        $data['user_id'] = Auth::user()->id;

        Informasi::create($data);
        return redirect(route('informasi.index'))->with('success', 'Berhasil menambahkan informasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('informasi.index'))->with('error', $e);
        }
        $informasi = Informasi::where('id', $decryptedId)->first();
        $komentars = KomentarInformasi::where('informasi_id', $informasi->id)->whereNull('komentar_informasi_id')->get();
        $nastedKomentar = KomentarInformasi::where('informasi_id', $informasi->id)->whereNotNull('komentar_informasi_id')->get();
        return view('dashboard.informasi.show-informasi', compact('informasi', 'komentars', 'nastedKomentar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('informasi.index'))->with('error', $e);
        }
        $informasi = Informasi::where('id', $decryptedId)->first();
        return view('dashboard.informasi.edit-informasi', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInformasiRequest  $request
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|min:3|max:255',
            'body' => 'required'
        ]);

        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('informasi.index'))->with('error', $e);
        }

        $informasi = Informasi::where('id', $decryptedId)->first();

        $storage = "foto-informasi/";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $data['body'] = $dom->saveHTML();
        $informasi->update($data);
        return redirect(route('informasi.index'))->with('success', 'Berhasil merubah informasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect(route('informasi.index'))->with('error', $e);
        }
        $informasi = Informasi::where('id', $decryptedId)->first();
        $informasi->delete();
        return redirect(route('informasi.index'))->with('success', 'Berhasil menghapus informasi');
    }
}
