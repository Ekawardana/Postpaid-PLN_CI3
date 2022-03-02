<html>

<head>
    <title></title>
</head>

<body>
    <style>
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding: 10px 10px 10px 10px;
        }

        h3 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

    <h3>
        <center>CETAK LAPORAN PEMBAYARAN</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No Pembayaran</th>
                <th>Nama</th>
                <th>Nomor KWH</th>
                <th>Tanggal Bayar</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Jumlah Meter</th>
                <th>Biaya Admin</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($items as $i) {
            ?>
                <tr>
                    <td scope="row"><?= $i['id_pembayaran']; ?></td>
                    <td><?= $i['nama_pelanggan']; ?></td>
                    <td><?= $i['nomor_kwh']; ?></td>
                    <td><?= date('d F Y', $i['tgl_bayar']); ?></td>
                    <td><?= $i['meter_awal']; ?></td>
                    <td><?= $i['meter_akhir']; ?></td>
                    <td><?= $i['jumlah_meter']; ?></td>
                    <td><?= 'Rp.' . $i['biaya_admin']; ?></td>
                    <td><?= 'Rp.' . $i['total_bayar']; ?></td>
                    <td><?= $i['status']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>