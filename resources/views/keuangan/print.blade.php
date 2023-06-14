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
            <h4>Nama : ksd</h4>
            <h4>No Hp : 0347983498</h4>
            <h4>Status : Sudah </h4>
        </div>
        <div class="row_1"> 
            <h4>Dibuat : {{ date("d, F Y",strtotime(now())) }} </h4>
            <h4>Alamat : sjs</h4>
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
            @endforeach
        </tbody>
    </table>
    <script>
        window.print()
    </script>
</body>

</html>
