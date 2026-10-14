<?php
include 'koneksi.php';

$stmt = $pdo->query("SELECT * FROM siswa ORDER BY id DESC");
$siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Nilai Siswa</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Animated Gradient Background */
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px 20px;
      background: linear-gradient(-45deg, #0f172a, #1e1b4b, #311042, #0f172a);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      color: #fff;
    }

    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /* Glassmorphism Container */
    .container {
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 30px;
      width: 100%;
      max-width: 900px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    h2 {
      font-weight: 700;
    }

    .btn {
      padding: 10px 18px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.2s ease;
      display: inline-block;
      border: none;
      cursor: pointer;
    }

    .btn-add {
      background: #3b82f6;
      color: white;
    }

    .btn-add:hover {
      background: #2563eb;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    /* ---> PASTE KODE CSS TOMBOL CETAK DI SINI <--- */
    .btn-print {
      background: #10b981;
      color: white;
      padding: 9px 16px;
      font-size: 0.9rem;
    }

    .btn-print:hover {
      background: #059669;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }

    .btn-edit {
      background: #f59e0b;
      color: white;
      padding: 6px 12px;
      font-size: 0.8rem;
    }

    .btn-edit:hover {
      background: #d97706;
    }

    .btn-delete {
      background: #ef4444;
      color: white;
      padding: 6px 12px;
      font-size: 0.8rem;
    }

    .btn-delete:hover {
      background: #dc2626;
    }

    /* Table Styling */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      overflow: hidden;
      border-radius: 10px;
    }

    th,
    td {
      padding: 14px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    th {
      background: rgba(255, 255, 255, 0.1);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
    }

    tr:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .badge {
      padding: 4px 10px;
      border-radius: 12px;
      font-weight: bold;
      font-size: 0.8rem;
    }

    .badge-a {
      background: #10b981;
    }

    .badge-b {
      background: #3b82f6;
    }

    .badge-c {
      background: #f59e0b;
    }

    .badge-d {
      background: #ef4444;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">
      <h1>📊 Data Nilai Siswa</h1>
      <div class="btn-group">
        <a href="../index.php" class="btn btn-back">⬅️ Menu Utama</a>

        <!-- SISIPKAN KODE TOMBOL CETAK TEPAT DI SINI -->
        <a href="cetak.php" target="_blank" class="btn btn-print">🖨️ Cetak / PDF</a>
        <!-- ======================================== -->

        <!-- Tombol Export Excel -->
        <a href="export_excel.php" class="btn btn-excel" style="background: #10b981; color: white; padding: 9px 16px; border-radius: 10px; text-decoration: none; font-weight: 600;">📊 Export Excel</a>

        <a href="tambah.php" class="btn btn-add">➕ Tambah Data</a>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Mata Pelajaran</th>
          <th>Nilai</th>
          <th>Predikat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($siswa) > 0): ?>
          <?php $no = 1;
          foreach ($siswa as $row): ?>
            <?php
            $n = $row['nilai'];
            if ($n >= 85) {
              $grade = 'A';
              $badge = 'badge-a';
            } elseif ($n >= 75) {
              $grade = 'B';
              $badge = 'badge-b';
            } elseif ($n >= 65) {
              $grade = 'C';
              $badge = 'badge-c';
            } else {
              $grade = 'D';
              $badge = 'badge-d';
            }
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['nama']); ?></td>
              <td><?= htmlspecialchars($row['mata_pelajaran']); ?></td>
              <td><?= $row['nilai']; ?></td>
              <td><span class="badge <?= $badge; ?>"><?= $grade; ?></span></td>
              <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align: center; color: rgba(255,255,255,0.6);">Belum ada data nilai.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>

</html>