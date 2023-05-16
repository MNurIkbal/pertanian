<?php


namespace App\Http\Controllers;

use App\Models\NyewaModel;
use App\Models\PembayaranModel;
use App\Models\PenyewaanModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $role = session('role');
        $data = [
            'result'    => NyewaModel::where("penyewaan_id", $id)->where('status','aktif')->orwhere('status','selesai')->get(),
            'first' =>  PenyewaanModel::where('id',$id)->first(),
            'role'  =>  $role,
        ];
        return view('keuangan.detail_penyewa', $data);
    }

    public function edit_bayar_sekarang(Request $request)
    {
        $id = $request->id;
        
        $tujuan_upload = 'assets/img/';
        $file = $request->file("foto");
        if(isset($file)) {
            $nama_file = $file->getClientOriginalName();
            $file->move($tujuan_upload, $file->getClientOriginalName());
        } else {
            $nama_file = $request->foto_lama;
        }

        $rupiah = str_replace(".", "", $request->nominal);
        $id = $request->id;
            $result = NyewaModel::where("id",$id)->first();
            $check = PenyewaanModel::where("id",$result->penyewaan_id)->first();
    
    
            if($rupiah > $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Lebih');
            } elseif($rupiah < $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Kurang');
            }
        
        
        try {
            DB::table("pembayaran")->update([
                'nominal'   =>  $rupiah,
                'img'   =>  $nama_file,
                'pesan' =>  $request->pesan
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
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  User::where("id",$result->user_id)->first(),
            'first' =>  PenyewaanModel::where("id",$result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id',$result->user_id)->count()
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
    
            $rupiah = str_replace(".", "", $request->nominal);
            if($rupiah > $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Lebih');
            } elseif($rupiah < $check->biaya) {
                return redirect()->back()->with('error','Maaf Nominal Anda Kurang');
            }

            $bayar = new PembayaranModel();
            $bayar->user_id = $result->user_id;
            $bayar->nominal = $rupiah;
            $bayar->img = $nama_file;
            $bayar->created_at = now();
            $bayar->nyewa_id = $id;
            $bayar->pesan = $request->pesan;
            $bayar->save();

            $today =$result->jatuh_tempo; // Tanggal hari ini
            $nextMonth = date('Y-m-d', strtotime('+1 month', strtotime($today)));
            NyewaModel::where("id",$id)->update([
                'jatuh_tempo'   => $nextMonth
            ]);
            return redirect()->back()->with('success',"Data Berhasil Di Tambahkan");
        } catch (\Throwable $th) {
            return redirect()->back()->with('success',"Data Gagal Di Tambahkan");
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
    public function selesai_bayar($id,$user_id)
    {
        try {
            //code...
            NyewaModel::where("id",$id)->update([
                'status'    =>  'selesai'
            ]); 
            return redirect()->back()->with('success',"Data Berhasil Update");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Data Gagal Update");
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus_bayar($id)
    {
        try {
            PembayaranModel::where("id",$id)->delete();
            return redirect()->back()->with('success',"Data Berhasil Dihapus");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Data Gagal Dihapus");
            //throw $th;
        }
    }

    public function bayar_pekerjaan($id)
    {
        $result = NyewaModel::where("id", $id)->first();
        $data = [
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id',$result->user_id)->get(),
            'id'    =>  $id,
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  User::where("id",$result->user_id)->first(),
            'first' =>  PenyewaanModel::where("id",$result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id',$result->user_id)->count()
        ];

        return view('keuangan.pembayaran_pekerjaan', $data);
    }
}
