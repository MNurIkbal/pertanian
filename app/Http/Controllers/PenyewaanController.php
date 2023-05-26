<?php

namespace App\Http\Controllers;

use App\Models\AlatModel;
use App\Models\NyewaModel;
use App\Models\PenyewaanModel;
use App\Models\User;
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
            'alat'  =>  AlatModel::where("active","1")->get()
        ];
        return view("penyewaan.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_data_nyewa()
    {

        $data = [
            'result'    =>  PenyewaanModel::all(),
        ];
        return view('penyewaan.tambah_nyewa', $data);
    }

    public function detail_penyewa($id)
    {
        $data = [
            'hasil' =>  PenyewaanModel::where('id',$id)->first(),
            'result'    => NyewaModel::where("penyewaan_id", $id)->where('status','belum aktif')->orwhere('status','aktif')->get()
        ];
        return view('penyewaan.detail_penyewa', $data);
    }

    public function approve(Request $request)
    {
        try {
            $id = $request->id;

            $result = NyewaModel::where('id', $id)->first();
            $hasil = PenyewaanModel::where("id", $result['penyewaan_id'])->first();

            if ($result->unit_nyewa > $hasil->unit) {
                return redirect()->back()->with('error', 'Maaf Alat Ini Sedang Kosong');
            }
            NyewaModel::where("id", $id)->update([
                'status'    =>  'aktif'
            ]);

            PenyewaanModel::where("id", $result['penyewaan_id'])->update([
                'unit'  =>  $hasil->unit - $result->unit_sewa
            ]);

            return redirect()->back()->with('success', "Data Berhasil Diupdate");
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', "Data Gagal Diupdate");
        }
    }

    public function tolak_approve(Request $request, $id)
    {
        try {

            $pesan = $request->pesan;
            NyewaModel::where("id", $id)->update([
                'status'    =>  'tolak',
                'pesan_tolak' =>  $pesan
            ]);

            return redirect()->back()->with('success', "Data Berhasil Diupdate");
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', "Data Gagal Diupdate");
        }
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

            $rupiah = str_replace(".", "", $request->biaya);

            $nyewa = new PenyewaanModel();
            $nyewa->nama_penyedia = $request->nama_penyedia;
            $nyewa->nama_alat = $request->nama_alat;
            $nyewa->luas_tanah = $request->tanah;
            $nyewa->expired = $request->expired;
            $nyewa->biaya = $rupiah;
            $nyewa->pesan = $request->alamat;
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
            'result'    =>  NyewaModel::where('user_id', $id)->get()
        ];

        return view("penyewaan.nyewa_petani", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pesan_sekarang(Request $request)
    {
        $alamat = $request->alamat;
        $no_hp = $request->no_hp;
        $lama_nyewa = $request->lama_nyewa;
        $unit = $request->unit_sewa;

        $id = $request->id;
        $result = PenyewaanModel::where("id", $id)->first();

        if ($unit > $result->unit) {
            return redirect()->to('nyewa_petani')->with('error', 'Unit Yang Di Sewa Terlalu Banyak');
        }

        try {
            $today = date('Y-m-d'); // Tanggal hari ini
            $nextMonth = date('Y-m-d', strtotime("+$lama_nyewa day", strtotime($today)));
            

            $nyewa = new NyewaModel();
            $nyewa->penyewaan_id = $id;
            $nyewa->user_id = session('id');
            $nyewa->created_at  = now();
            $nyewa->status = "belum aktif";
            $nyewa->img = null;
            $nyewa->alamat = $alamat;
            $nyewa->active = 1;
            $nyewa->no_hp = $no_hp;
            $nyewa->unit_sewa = $unit;
            $nyewa->lama_nyewa = $lama_nyewa;
            $nyewa->jatuh_tempo = $nextMonth;
            $nyewa->save();


            return redirect()->to('nyewa_petani')->with('success', "Data Berhasil Di Tambahkan");
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('nyewa_petani')->with('error', "Data Gagal Di Tambahkan");
        }
    }

    public function hapus_nyewa_detail($id)
    {
        $result = NyewaModel::where("id", $id)->where("status", "belum aktif")->first();
        if ($result) {
            NyewaModel::where("id", $id)->where("status", "belum aktif")->delete();
            return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
        } else {
            return redirect()->back()->with('error', 'Data Gagal Di Hapus');
        }
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
        if (isset($file)) {
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());
        } else {
            $nama_file = $img_lama;
        }
        $rupiah = str_replace(".", "", $request->biaya);
        try {
            //code...
            PenyewaanModel::where("id", $id)->update([
                'nama_penyedia'    =>  $request->nama_penyedia,
                'nama_alat' =>  $request->nama_alat,
                'luas_tanah'    =>  $request->luas_tanah,
                'expired'   =>  $request->expired,
                'biaya' =>  $rupiah,
                'pesan' =>  $request->pesan,
                'img'   =>  $nama_file,
                'unit'  =>  $request->unit
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Gagal Diupdate');
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
            $result = NyewaModel::where("penyewaan_id", $id)->count();
            if ($result) {
                return redirect()->back()->with('error', "Data Ini Tidak Boleh Di Hapus Karena Sudah Berelasi");
            }

            PenyewaanModel::where("id", $id)->delete();
            return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Gagal Di Hapus');
            //throw $th;
        }
    }

    public function edit_pesan_sekarang(Request $request)
    {
        $id = $request->id;
       

        try {
            $today = date('Y-m-d'); // Tanggal hari ini
            $lama_nyew = $request->lama_nyewa;
            $nextMonth = date('Y-m-d', strtotime("+$lama_nyew day", strtotime($today)));
            // dd($nextMonth);
            NyewaModel::where("id",$id)->update([
                'alamat'    =>  $request->alamat,
                'no_hp' =>  $request->no_hp,
                'unit_sewa' =>  $request->unit_sewa,
                'lama_nyewa'    =>  $lama_nyew,
                'jatuh_tempo'   =>  $nextMonth
            ]);

            return redirect()->back()->with('success','Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Diupdate');
            //throw $th;
        }
    }
}
