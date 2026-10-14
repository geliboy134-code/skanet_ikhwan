<?php
// Masukkan koneksi database dan cek session login
include "koneksi.php";
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
    header('location:../login.php');
    exit();
}

// Header HTTP untuk memaksa browser mendownload file sebagai Excel (.xls)
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Data_Nilai_Siswa.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Export Data Nilai ke Excel</title>
    <style>
        /* Styling opsional agar tabel rapi saat dibuka di Microsoft Excel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">LAPORAN DATA NILAI SISWA</h2>
    <p style="text-align: center;">Sistem Informasi Akademik & Nilai</p>
    <br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Guru Pengampu</th>
                <th>Mata Pelajaran</th>
                <th>Nilai Angka</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query untuk menggabungkan data dari tabel nilai, siswa, guru, dan mapel (menyesuaikan struktur database)
            $query = mysqli_query($koneksi, "
                SELECT nilai.*, siswa.nama AS nama_siswa, guru.nama AS nama_guru, mapel.mapel AS nama_mapel 
                FROM nilai 
                JOIN siswa ON nilai.nis = siswa.nis 
                JOIN guru ON nilai.nip = guru.nip 
                JOIN mapel ON nilai.id_mapel = mapel.id_mapel
            ");

            $no = 1;
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    // Logika predikat nilai (bisa disesuaikan dengan aturan yang ada di index nilai Anda)
                    $nilai_angka = $data['nilai'];
                    if ($nilai_angka >= 85) {
                        $predikat = "A (Sangat Baik)";
                    } elseif ($nilai_angka >= 75) {
                        $predikat = "B (Baik)";
                    } elseif ($nilai_angka >= 65) {
                        $predikat = "C (Cukup)";
                    } else {
                        $predikat = "D (Kurang)";
                    }
            ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($data['nis']); ?></td>
                        <td><?php echo htmlspecialchars($data['nama_siswa']); ?></td>
                        <td><?php echo htmlspecialchars($data['nama_guru']); ?></td>
                        <td><?php echo htmlspecialchars($data['nama_mapel']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($nilai_angka); ?></td>
                        <td class="text-center"><?php echo $predikat; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada data nilai.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>