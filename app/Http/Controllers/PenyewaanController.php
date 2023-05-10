<?php

namespace App\Http\Controllers;

use App\Models\NyewaModel;
use App\Models\PenyewaanModel;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'result'    =>  PenyewaanModel::all(),
        ];
        return view("penyewaan.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $tujuan_upload = 'assets/img/';
            $file = $request->file("foto");
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());

            $nyewa = new PenyewaanModel();
            $nyewa->nama_nyewa = $request->nama_alat;
            $nyewa->jenis = $request->jenis;
            $nyewa->satuan = $request->satuan;
            $nyewa->expired = $request->expired;
            $nyewa->biaya = $request->biaya;
            $nyewa->pesan = $request->pesan;
            $nyewa->created_at = now();
            $nyewa->img = $nama_file;
            $nyewa->unit = $request->unit;
            $nyewa->save();
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', 'Data Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function nyewa_petani()
    {
        $id = session('id');
        $data = [
            'result'    =>  NyewaModel::where('id',$id)->get()
        ];

        dd($data['result']);
        return view("penyewaan.nyewa_petani", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $img_lama = $request->foto_lama;

        $tujuan_upload = 'assets/img/';
        $file = $request->file("foto");
        if(isset($file)) {
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());
        } else {
            $nama_file = $img_lama;
        }

        try {
            //code...
            PenyewaanModel::where("id",$id)->update([
                'nama_nyewa'    =>  $request->nama_alat,
                'jenis' =>  $request->jenis,
                'satuan'    =>  $request->satuan,
                'expired'   =>  $request->expired,
                'biaya' =>  $request->biaya,
                'pesan' =>  $request->pesan,
                'img'   =>  $nama_file,
                'unit'  =>  $request->unit
            ]);
    
            return redirect()->back()->with('success','Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Diupdate');
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            PenyewaanModel::where("id",$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Di Hapus');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Di Hapus');
            //throw $th;
        }
    }
}
