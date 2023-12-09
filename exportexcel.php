<?php
include "koneksi.php";

// Persiapan untuk file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename = Export Excel Data Pengunjung.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="6">Rekapitulasi Data Pengunjung</th>
        </tr>
        <tr>
            <th>N0.</th>
            <th>Tanggal</th>
            <th>Nama Pengunjung</th>
            <th>Alamat</th>
            <th>Tujuan</th>
            <th>No. HP</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tgl1 =$_POST['tanggala'];
        $tgl2 =$_POST['tanggalb'];
        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu WHERE tanggal BETWEEN '$tgl1' and '$tgl2' ORDER BY id DESC");
        $no = 1;

        while ($data = mysqli_fetch_array($tampil)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['tanggal'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['tujuan'] ?></td>
                <td><?= $data['nope'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
