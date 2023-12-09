<?php include "header.php"; ?>

<?php
include "koneksi.php"; // Pastikan file koneksi.php sudah ada dan berisi koneksi ke database

// Uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');
    // htmlspecialchars agar inputan lebih aman dari injection
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['Alamat'], ENT_QUOTES); // Sesuaikan dengan name pada form
    $tujuan = htmlspecialchars($_POST['Tujuan'], ENT_QUOTES); // Sesuaikan dengan name pada form
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    // Persiapan query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('', '$tgl', '$nama', '$alamat', '$tujuan', '$nope')");

    // Uji jika simpan data sukses
    if ($simpan) {
        echo "<script>alert('Simpan data Sukses, Terima Kasih..!'); document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data GAGAL !!!'); document.location='?'</script>";
    }
}
?>

<!--- head  --->
<div class="head text-center">
    <img src="asset/img/logo politani.png">
    <h2 class="text-white" style="font-weight: bold;  ">Sistem Informasi Buku Tamu Politani Samarinda</h2>
</div>

    <style>
    .head {
   
    background-size: cover;
    background-position: center;
    padding: 20px;
    }


    .head img {
        max-width: 100px; /* Atur lebar maksimal yang diinginkan */
        height: auto; /* Biarkan tinggi otomatis agar gambar tidak terdistorsi */
        display: block; /* Menjaga gambar tetap di dalam kotak div */
        margin: 0 auto; /* Menengahkan gambar di dalam div */
    }

    .head h2 {
        margin-top: 10px; /* Jarak atas antara gambar dan teks */
        color: white; /* Menetapkan warna teks putih */
    }
</style>
</div>
<!---end head---->

<!--- awal row--->
<div class="row mt-2">
    <!-- col-lg-7-->
    <div class="col-lg-7 mb-5">
        <div class="card shadow bg-gradient-light">
            <!-- card body-->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-5" style="font-weight: bold;  "> Identitas Pengunjung</h1>
                </div>
                <form class="user " method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control from-control-user " name="nama" placeholder="Nama Pengunjung" required>
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control from-control-user" name="Alamat" placeholder="Alamat Pengunjung" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control from-control-user" name="Tujuan" placeholder="Tujuan pengunjung" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control from-control-user" name="nope" placeholder="NO.hp Pengunjung" required>
                    </div>
                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="#">Politani Samarinda | 2023 - <?= date('Y') ?></a>
                </div>
            </div>
            <!-- end card-body-->
        </div>
    </div>
    <!-- end col-lg-7-->

    <!-- col-lg-5-->
    <div class="col-lg-5 mb-3">
        <div class="card shadow ">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4" style="font-weight: bold;  "> Statistik Pengunjung</h1>
                </div>
                <?php
                    
                    // deklarasi tanggal
                    
                    // menampilkan tanggal sekarang
                    $tgl_sekarang = date('Y-m-d');
                    
                    // menampilkan tanggal kemarin
                    $kemarin = date('Y-m-d', strtotime('-1 day', strtotime($tgl_sekarang)));
                    
                    // mendapatkan 6 hari sebelum tanggal sekarang
                    $seminggu = date('Y-m-d', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
                    
                    // persiapan query tampilkan jumlah data pengunjung
                    $query_tgl_sekarang = mysqli_query($koneksi, "SELECT count(*) FROM ttamu WHERE tanggal LIKE '%$tgl_sekarang%'");
                    $query_kemarin = mysqli_query($koneksi, "SELECT count(*) FROM ttamu WHERE tanggal LIKE '%$kemarin%'");
                    $query_seminggu = mysqli_query($koneksi, "SELECT count(*) FROM ttamu WHERE tanggal BETWEEN '$seminggu' AND '$tgl_sekarang'");

                    $bulan_ini = date('m');
                    
                    $query_sebulan = mysqli_query($koneksi, "SELECT count(*) FROM ttamu WHERE MONTH(tanggal) = '$bulan_ini'");
                    $query_keseluruhan = mysqli_query($koneksi, "SELECT count(*) FROM ttamu");
                    
                    // ambil hasil query
                    $tgl_sekarang_result = mysqli_fetch_array($query_tgl_sekarang);
                    $kemarin_result = mysqli_fetch_array($query_kemarin);
                    $seminggu_result = mysqli_fetch_array($query_seminggu);
                    $sebulan_result = mysqli_fetch_array($query_sebulan);
                    $keseluruhan_result = mysqli_fetch_array($query_keseluruhan);
                    
                    
                    ?>
                    
                    <table class="table table-bordered">
                        <tr>
                            <td>Hari ini</td>
                            <td>: <?= $tgl_sekarang_result[0] ?></td>
                        </tr>
                        <tr>
                            <td>Kemarin</td>
                            <td>: <?= $kemarin_result[0] ?></td>
                        </tr>
                        <tr>
                            <td>Minggu ini</td>
                            <td>: <?= $seminggu_result[0] ?></td>
                        </tr>
                        <tr>
                            <td>Bulan ini</td>
                            <td>: <?= $sebulan_result[0] ?></td>
                        </tr>
                        <tr>
                            <td>Keseluruhan</td>
                            <td>: <?= $keseluruhan_result[0] ?></td>
                        </tr>
                    </table>
                    
            </div>
            <!-- card body-->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-lg-5-->
</div>
<!-- end row-->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?= date('d-m-Y') ?>]</h6>
    </div>
    <div class="card-body">

        <a href="rekapitulasi.php" class="btn btn-success mb-3">
            <i class="fa fa-table"></i> Rekapitulasi Pengunjung</a>

            <a href="logout.php" class="btn btn-danger mb-3">
            <i class="fa fa-sign-out-alt"></i>Logout</a>
        

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N0.</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>N0.</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
           $tgl1 = isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d');
$tgl2 = isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d');

// ...

$tampil = mysqli_query($koneksi, "SELECT * FROM ttamu WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' ORDER BY id DESC");
$no = 1;
while ($data = mysqli_fetch_array($tampil)) {
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['tanggal'] ?></td>
        <td><?= $data['nama'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td><?= $data['tujuan'] ?></td>
        <!-- Sisipkan kolom No. HP jika ada -->
        <td><?= $data['nope'] ?></td>
    </tr>
<?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- panggil file footer -->
<?php include "footer.php"; ?>
