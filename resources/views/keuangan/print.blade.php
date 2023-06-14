<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Keuangan</title>
    <style>
        table {
            border: 1px solid black;
            width: 100%;
            height: 100%;
        }

        table tr td,
        th {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        h4 {
            text-align: center;
        }

        .title {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 40px;
            justify-items: center;
            margin-bottom: 30px;
        }

        .title h4 {
            text-align: left;
        }
    </style>
</head>

<body>
    <h4>LAPORAN KEUANGAN</h4>
    <div class="title">
        <div class="row_1">
            <h4>Nama Penyedia : {{ $penyewaan->nama_penyedia }}</h4>
            <h4>Nama Alat : {{ $penyewaan->alat->nama }}</h4>
            <h4>Biaya : Rp. {{ number_format($penyewaan->biaya) }} </h4>
        </div>
        <div class="row_1"> 
            <h4>Tanggal Mulai : {{ date("d, F Y",strtotime($mulai)) }} </h4>
            <h4>Tanggal Akhir : {{ date("d, F Y",strtotime($akhir)) }} </h4>
            <h4>Total Pendapatan : Rp.   {{ number_format($hasil) }}</h4>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyedia</th>
                <th>Nama Alat</th>
                <th>Unit</th>
                
                <th>Lama Nyewa</th>
                <th>Dibuat</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
            @php
                $hasil_nyewa = App\Models\PenyewaanModel::where('id',$row->penyewaan_id)->first();
                $id_alat = $hasil_nyewa->nama_alat;
                $nama_alat = App\Models\AlatModel::where('id',$id_alat)->first();
                $pembayarans = App\Models\PembayaranModel::where("nyewa_id",$row->id)->first();
                
            @endphp
               <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $hasil_nyewa->nama_penyedia }}</td>
                <td>{{ $nama_alat->nama }}</td>
                <td>{{ $row->unit_sewa }} Unit</td>
                <td>{{ $row->lama_nyewa }} Hari</td>
                <td>{{ date("d, F Y",strtotime($row->created_at)) }}</td>
                <td>{{ date("d, F Y",strtotime($row->jatuh_tempo)) }}</td>
               </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print()
    </script>
</body>

</html>
