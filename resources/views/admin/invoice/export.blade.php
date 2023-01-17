<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* table,
        th,
        td {
            border: 1px solid black;
        } */
        hr.garis-atas {
            border: 2px solid #000;
        }

        .baris-baru {
            padding-top: 20px;
        }

        .batas-kiri {
            font-size: 12px;
            margin-left: 40px
        }

        .baris-ttd {
            font-size: 12px;
            padding-top: 80px;
        }

        .baris-isi-ttd {
            font-size: 12px;
            font-weight: bold;
            padding-top: 60px;
        }

        .batas-kanan {
            margin-left: 40px
        }

        .watermark {
            /* margin-top: 17%;
            margin-left: 34%; */
            position: fixed;
            top: 20%;
            left: 30%;
            opacity: 0.2;
            z-index: 99;
            color: white;
            width: 40%;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            font-family: Arial, Helvetica, sans-serif;
        }

        .judul-data {
            font-size: 12px;
            font-weight: bold;
        }

        .value-data {
            font-size: 15px;
            font-weight: bold;
        }

        .alamat {
            font-size: 15px;
            font-weight: bold;
        }

        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .title-td {
            font-weight: bold;
            height: 30px;
            background-color: rgb(158, 157, 157);
            text-align: center
                /* padding-top: 2px; */
        }

        .text-uang {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="batas-kiri batas-kanan">
        <p style="color:#EF265C"><i>INVOICE - {{ $data->id_invoice }}</i></p>
    </div>
    {{-- {{ dd($data) }} --}}
    <hr class="garis-atas">
    <div class="batas-kiri batas-kanan" style="padding-top: 2%">
        <table style="width:100%">
            <tr>
                <td class="title-td">NO</td>
                <td class="title-td">Nama Produk</td>
                <td class="title-td">Harga Produk</td>
                <td class="title-td">Jumlah Produk</td>
                <td class="title-td">Total Harga</td>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach ($data->products as $item)
              <tr>
                  <td class="">{{ $loop->iteration }}</td>
                  <td class="">{{ $item->nama_produk }}</td>
                  <td class="text-uang">Rp {{ number_format($item->harga_produk) }}</td>
                  <td class="text-uang">{{ $item->pivot->jumlah }}</td>
                  <td class="text-uang">Rp {{ number_format($item->harga_produk * $item->pivot->jumlah,0,',','.')}}</td>
                  @php
                    $total += $item->harga_produk * $item->pivot->jumlah
                  @endphp
              </tr>
            @endforeach
            <tr>
                <td class="title-td" colspan="4">Total</td>
                <td class="text-uang title-td">Rp {{ number_format($total) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>