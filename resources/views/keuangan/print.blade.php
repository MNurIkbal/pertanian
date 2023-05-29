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
            <h4>Nama : {{ $main->name }}</h4>
            <h4>No Hp : {{ $hasil->no_hp }}</h4>
            <h4>Status : @if ($hasil->status == "tolak")
                Tolak
                @elseif($hasil->status == "selesai")
                Selesai
                @elseif($hasil->status == "belum aktif")
                Belum Di Acc
                @elseif ($hasil->status == "aktif")
                Sudah Di Acc
            @endif </h4>
        </div>
        <div class="row_1"> 
            <h4>Dibuat : {{ date("d, F Y",strtotime(now())) }} </h4>
            <h4>Alamat : {{ $hasil->alamat }}</h4>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyedia</th>
                <th>Nama Alat</th>
                <th>Unit</th>
                <th>Dibayar</th>
                <th>Lama Nyewa</th>
                <th>Dibuat</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
                @php
                    $nyewar = App\Models\NyewaModel::where('id', $row->nyewa_id)->first();
                    $penyedia = App\Models\PenyewaanModel::where('id', $nyewar->penyewaan_id)->first();
                    $alat = App\Models\AlatModel::where('id', $penyedia->nama_alat)->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penyedia->nama_penyedia }}</td>
                    <td>{{ $penyedia->alat->nama }}</td>
                    <td>{{ $nyewar->unit_sewa }} Unit</td>
                    <td>Rp. {{ number_format($row->nominal, 0) }}</td>
                    <td>{{ $nyewar->lama_nyewa }} Hari</td>
                    <td>{{ date('d, F Y', strtotime($row->created_at)) }}</td>
                    <td>{{ date('d, F Y', strtotime($nyewar->jatuh_tempo)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print()
    </script>
</body>

</html>
