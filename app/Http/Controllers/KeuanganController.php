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
        $sesi = session('role');
        $id = session('id');
        if($sesi == '2') {
            $penyewaan = PenyewaanModel::orderBy('id', 'desc')->get();

            $data = [
                'result'    =>  $penyewaan,
                'id'    =>  $id
            ];
            return view("keuangan.keuangan_index", $data);

        } else {

            $data = [
                'result'    =>  PenyewaanModel::orderby('id', 'desc')->get(),
            ];
            return view("keuangan.index", $data);
        }
    }

    public function print_laporan(Request $request)
    {
        $id = $request->id;
        $start = $request->start;
        $end = $request->end;

        if ($end < $start) {
            return redirect()->back()->with('error', 'Input Tidak Valid');
        }

        // try {
            //code...
            $result = NyewaModel::where('penyewaan_id', $id)
                ->whereBetween('created_at', [$start, $end])
                ->count();

            if (!$result) {
                return redirect()->back()->with('error', 'Data Tidak Ditemukan');
            }
            $query = NyewaModel::where('penyewaan_id', $id)
                ->whereBetween('created_at', [$start, $end])
                ->where("status","selesai")
                ->get();
                
                $total = NyewaModel::join('pembayaran', 'nyewa.id', '=', 'pembayaran.nyewa_id')
                ->where('nyewa.penyewaan_id', $id)
                ->where("nyewa.status",'selesai')
                ->whereBetween('nyewa.created_at', [$start, $end])
                ->sum('pembayaran.nominal');

            $penyewaan = PenyewaanModel::where("id", $id)->first();
            $data = [
                'result'    =>  $query,
                'penyewaan' =>  $penyewaan,
                'mulai' =>  $start,
                'akhir' =>  $end,
                'hasil' =>  $total,
            ];
            return view('keuangan.print', $data);
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        //     //throw $th;
        // }
    }

    public function detal_pembayaran($id)
    {
        $results = NyewaModel::where("id", $id)->count();
        if (!$results) {
            return redirect()->to('penyewaan');
        }
        $result = NyewaModel::where("id", $id)->first();
        $rt = PenyewaanModel::where("id", $result->penyewaan_id)->first();
        $total_sewa = $result->unit_sewa * $rt->biaya;
        $data = [
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->get(),
            'id'    =>  $id,
            'total_sewa'    =>  $total_sewa,
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  PenyewaanModel::where("id", $result->penyewaan_id)->first(),
            'first' =>  PenyewaanModel::where("id", $result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->count()
        ];
        // dd(session())
        return view("keuangan.pembayaran", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail_penyewa_keuangan($id)
    {

        $role = session('role');
        $main = PenyewaanModel::where('id', $id)->first();
        if (!$main) {
            return redirect()->back();
        }

        // $nyewa = PembayaranModel::join('nyewa','pembayaran.nyewa_id','=','nyewa.id')->join('penyewaan','penyewaan.id','=','nyewa.penyewaan_id')->first();
        $nyewa = PembayaranModel::join('nyewa', 'pembayaran.nyewa_id', '=', 'nyewa.id')
            ->join('penyewaan', 'penyewaan.id', '=', 'nyewa.penyewaan_id')
            ->select(DB::raw('SUM(pembayaran.nominal) as total_nominal'))
            ->where('penyewaan.id', $id)
            ->where('nyewa.status', 'selesai')
            ->first();



        $data = [
            'result'    => NyewaModel::where("penyewaan_id", $id)->where('status', 'selesai')->get(),
            'first' =>  PenyewaanModel::where('id', $id)->first(),
            'role'  =>  $role,
            'total' =>  $nyewa,
            'id'    =>  $id
        ];
        return view('keuangan.detail_penyewa', $data);
    }

    public function edit_bayar_sekarang(Request $request)
    {
        $id = $request->id;
        try {
            DB::table("pembayaran")->where('id', $id)->update([
                'pesan' =>  $request->pesan
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Gagal Diupdate');
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
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->get(),
            'id'    =>  $id,
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  User::where("id", $result->user_id)->first(),
            'first' =>  PenyewaanModel::where("id", $result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->count(),
        ];

        return view('keuangan.laporan', $data);
    }
    public function print($id)
    {
        $result = NyewaModel::where("id", $id)->first();
        $data = [
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->get(),
            'id'    =>  $id,
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  User::where("id", $result->user_id)->first(),
            'first' =>  PenyewaanModel::where("id", $result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->count(),
        ];

        return view('keuangan.print', $data);
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


            $id = $request->id;
            $result = NyewaModel::where("id", $id)->first();
            $check = PenyewaanModel::where("id", $result->penyewaan_id)->first();

            $rupiah = str_replace(",", "", $request->nominal);
            // if($rupiah > $check->biaya) {
            //     return redirect()->back()->with('error','Maaf Nominal Anda Lebih');
            // } elseif($rupiah < $check->biaya) {
            //     return redirect()->back()->with('error','Maaf Nominal Anda Kurang');
            // }

            $bayar = new PembayaranModel();
            $bayar->user_id = $result->user_id;
            $bayar->nominal = $rupiah;
            $bayar->img = 'default.png';
            $bayar->created_at = now();
            $bayar->nyewa_id = $id;
            $bayar->pesan = $request->pesan;
            $bayar->save();

            // $today =$result->jatuh_tempo; // Tanggal hari ini
            // $lama = $result->lama_nyewa;
            // $nextMonth = date('Y-m-d', strtotime("+$lama day", strtotime($today)));
            // NyewaModel::where("id",$id)->update([
            //     'jatuh_tempo'   => $nextMonth
            // ]);
            NyewaModel::where("id", $id)->update([
                'status'    =>  'selesai'
            ]);
            return redirect()->back()->with('success', "Data Berhasil Di Tambahkan");
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', "Data Gagal Di Tambahkan");
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
    public function selesai_bayar($id, $user_id)
    {
        try {
            //code...
            NyewaModel::where("id", $id)->update([
                'status'    =>  'selesai'
            ]);
            return redirect()->back()->with('success', "Data Berhasil Update");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Data Gagal Update");
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
            PembayaranModel::where("id", $id)->delete();
            return redirect()->back()->with('success', "Data Berhasil Dihapus");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Data Gagal Dihapus");
            //throw $th;
        }
    }

    public function bayar_pekerjaan($id)
    {
        $result = NyewaModel::where("id", $id)->first();
        $data = [
            'result'    =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->get(),
            'id'    =>  $id,
            'user_id'   =>  $result->user_id,
            'hasil' =>  $result,
            'ids'   =>  $result->penyewaan_id,
            'main'  =>  User::where("id", $result->user_id)->first(),
            'first' =>  PenyewaanModel::where("id", $result->penyewaan_id)->first(),
            'check' =>  PembayaranModel::where("nyewa_id", $id)->where('user_id', $result->user_id)->count()
        ];

        return view('keuangan.pembayaran_pekerjaan', $data);
    }
}
