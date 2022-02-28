<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px 10px 10px 10px;
        }

        .table-data th {
            background-color: grey;
        }

        h3 {
            font-family: Verdana;
        }
    </style>
    <h3>
        <center>BUKTI PEMBAYARAN</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
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
            $no = 1;
            foreach ($items as $i) {
            ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
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