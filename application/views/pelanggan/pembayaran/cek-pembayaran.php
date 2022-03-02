<div class="col-md">
    <h3>
        <center>CEK PEMBAYARAN</center>
    </h3>
    <br />
    <table class="table table-hover table-bordered">
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
</div>
<!-- <script type="text/javascript">
        window.print();
    </script> -->