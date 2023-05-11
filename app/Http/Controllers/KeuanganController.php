<?php

namespace App\Http\Controllers;

use App\Models\NyewaModel;
use App\Models\PembayaranModel;
use App\Models\PenyewaanModel;
use Illuminate\Http\Request;

class KeuanganController extends Controller
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
        return view("keuangan.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail_penyewa_keuangan($id)
    {
        $data = [
            'result'    => NyewaModel::where("penyewaan_id", $id)->get()
        ];
        return view('keuangan.detail_penyewa', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayar($id)
    {
        $result = NyewaModel::where("id", $id)->first();
        $data = [
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id',$result->user_id)->get(),
            'id'    =>  $id,
            'ids'   =>  $result->penyewaan_id,
        ];

        return view('keuangan.pembayaran', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayar_sekarang(Request $request)
    {
        try {
            //code...
            $tujuan_upload = 'assets/img/';
            $file = $request->file("foto");
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());
    
            $id = $request->id;
            $result = NyewaModel::where("id",$id)->first();
            $check = PenyewaanModel::where("id",$result->penyewaan_id)->first();
    
            if($request->nominal > $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Kurang');
            } elseif($request->nominal > $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Lebih');
            }
            $bayar = new PembayaranModel();
            $bayar->user_id = $result->user_id;
            $bayar->nominal = $request->nominal;
            $bayar->img = $nama_file;
            $bayar->created_at = now();
            $bayar->nyewa_id = $id;
            $bayar->pesan = $request->pesan;
            $bayar->save();
            return redirect()->to('keuangan')->with('success',"Data Berhasil Di Tambahkan");
        } catch (\Throwable $th) {
            return redirect()->to('error')->with('success',"Data Gagal Di Tambahkan");
            //throw $th;
        }
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
