<?php

namespace App\Http\Controllers;

use App\Models\AlatModel;
use App\Models\PenyewaanModel;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'result'    =>  AlatModel::all()
        ];
        return view('alat.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_alat(Request $request)
    {
        $request->validate([
            'kode'  =>  'required',
            'nama_alat' =>  'required',
            'file'  =>  'required|mimes:png,jpg,jpeg|max:3000',
        ]);

        try {
            $tujuan_upload = 'assets/img/';
            $file = $request->file("file");
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());

            $alat = new AlatModel();
            $alat->nama = $request->nama_alat;
            $alat->active = $request->status;
            $alat->created_at = now();
            $alat->kode = $request->kode;
            $alat->img = $nama_file;
            $alat->save();
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
            //throw $th;
        }
    }
    public function edit_alat(Request $request)
    {
        $request->validate([
            'kode'  =>  'required',
            'nama_alat' =>  'required',
            'file'  =>  'mimes:png,jpg,jpeg|max:3000',
        ]);

        try {    
            $tujuan_upload = 'assets/img/';
            $file = $request->file("file");
            if(isset($file)) {
                $nama_file = $file->getClientOriginalName();
                $file->move($tujuan_upload, $file->getClientOriginalName());
            } else {
                $nama_file = $request->img_lama;
            }
            $id = $request->id;
            AlatModel::where("id",$id)->update([
                'nama'  =>  $request->nama_alat,
                'active'    =>  $request->status,
                'kode'  =>  $request->kode,
                'img'   =>  $nama_file,
            ]);
            return redirect()->back()->with('success','Data Berhasil Diupdate');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error','Data Gagal Diupdate');
                //throw $th;
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hapus_alat(Request $request)
    {
        try {
            $id = $request->id;
            $check = PenyewaanModel::where("nama_alat",$id)->count();
            if($check) {
                return redirect()->back()->with('error','Data Tidak Boleh Di Hapus Karena Sudah Berelasi');
            }
            AlatModel::where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success','Data Gagal Dihapus');
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
