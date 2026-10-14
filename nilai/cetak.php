<?php
session_start();
// Pengecekan Keamanan Session (opsional jika ingin diamankan)
// if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
//     header('location:../logout.php');
//     exit();
// }

include 'koneksi.php';

// AMBIL DATA MENGGUNAKAN $pdo DAN TABEL siswa (SESUAI INDEX.PHP)
try {
    $stmt = $pdo->query("SELECT * FROM siswa ORDER BY id DESC");
    $siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Gagal mengambil data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Nilai Siswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { padding: 30px; background: #fff; color: #000; }
        .header-laporan { text-align: center; border-bottom: 3px double #000; padding-bottom: 12px; margin-bottom: 20px; }
        .header-laporan h2 { font-size: 18pt; text-transform: uppercase; margin-bottom: 4px; }
        .header-laporan p { font-size: 10pt; color: #444; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #000; padding: 8px 10px; font-size: 10pt; }
        th { background-color: #f2f2f2 !important; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .ttd-container { width: 100%; display: flex; justify-content: flex-end; margin-top: 20px; }
        .ttd-box { text-align: center; width: 220px; font-size: 10pt; }
        .ttd-space { height: 60px; }
        
        /* Tombol Aksi */
        .btn-action { padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; display: inline-block; margin-bottom: 20px;}
        .btn-print { background: #10b981; color: white; }
        .btn-close { background: #6b7280; color: white; margin-left: 8px; }
        
        /* Hilangkan tombol saat dicetak */
        @media print { 
            .no-print { display: none !important; } 
            @page { size: A4 portrait; margin: 15mm; } 
            body { padding: 0; } 
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Panel Tombol (Akan hilang otomatis saat PDF tersimpan) -->
    <div class="no-print" style="margin-bottom: 25px; padding: 12px; background: #f3f4f6; border-radius: 8px;">
        <button onclick="window.print()" class="btn-action btn-print">🖨️ Cetak / Simpan PDF</button>
        <button onclick="window.close()" class="btn-action btn-close">❌ Tutup Tab</button>
    </div>

    <div class="header-laporan">
        <h2>LAPORAN HASIL EVALUASI NILAI SISWA</h2>
        <p>Sistem Informasi Akademik & Nilai</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Siswa</th>
                <th>Mata Pelajaran</th>
                <th width="15%">Nilai</th>
                <th width="15%">Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($siswa) > 0): ?>
                <?php $no = 1; foreach ($siswa as $row): 
                    $n = $row['nilai'];
                    if ($n >= 85) { $grade = 'A'; }
                    elseif ($n >= 75) { $grade = 'B'; }
                    elseif ($n >= 65) { $grade = 'C'; }
                    else { $grade = 'D'; }
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['mata_pelajaran']); ?></td>
                    <td class="text-center"><strong><?= $n; ?></strong></td>
                    <td class="text-center"><strong><?= $grade; ?></strong></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Belum ada data nilai.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Guru Pengampu,</p>
            <div class="ttd-space"></div>
            <p><strong>( ____________________ )</strong></p>
        </div>
    </div>

</body>
</html>