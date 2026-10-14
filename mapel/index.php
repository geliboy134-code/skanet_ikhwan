<?php
session_start();
// Cek status login jika diperlukan
if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
  header('location:../logout.php');
  exit();
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mata Pelajaran</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Background Gradient Animasi Modern */
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

    /* Container Glassmorphism */
    .container {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 30px;
      width: 100%;
      max-width: 800px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    }

    /* Header & Navigation */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      flex-wrap: wrap;
      gap: 15px;
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .btn-group {
      display: flex;
      gap: 10px;
    }

    /* Common Button Styles */
    .btn {
      display: inline-block;
      padding: 9px 16px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
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

    .btn-back {
      background: rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-back:hover {
      background: rgba(255, 255, 255, 0.2);
      color: white;
    }

    .btn-edit {
      background: #f59e0b;
      color: white;
      padding: 6px 12px;
      font-size: 0.82rem;
    }

    .btn-edit:hover {
      background: #d97706;
      transform: translateY(-1px);
    }

    .btn-delete {
      background: #ef4444;
      color: white;
      padding: 6px 12px;
      font-size: 0.82rem;
    }

    .btn-delete:hover {
      background: #dc2626;
      transform: translateY(-1px);
    }

    /* Modern Table Styles */
    .table-responsive {
      overflow-x: auto;
      border-radius: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(0, 0, 0, 0.15);
      border-radius: 12px;
      overflow: hidden;
    }

    th,
    td {
      padding: 14px 18px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    th {
      background: rgba(255, 255, 255, 0.1);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 0.8px;
      color: rgba(255, 255, 255, 0.9);
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background: rgba(255, 255, 255, 0.05);
    }

    .action-cell {
      display: flex;
      gap: 8px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">
      <h1>📚 Data Mapel</h1>
      <div class="btn-group">
        <a href="../index.php" class="btn btn-back">⬅️ Menu Utama</a>
        <a href="tambah.php" class="btn btn-add">➕ Tambah Data</a>
      </div>
    </div>

    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>ID Mapel</th>
            <th>Mata Pelajaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($koneksi, "SELECT * FROM mapel");
          if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {
          ?>
              <tr>
                <td><strong>#<?php echo htmlspecialchars($data['id_mapel']); ?></strong></td>
                <td><?php echo htmlspecialchars($data['mapel']); ?></td>
                <td>
                  <div class="action-cell">
                    <a href="edit.php?id_mapel=<?php echo $data['id_mapel']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id_mapel=<?php echo $data['id_mapel']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">Hapus</a>
                  </div>
                </td>
              </tr>
            <?php
            }
          } else {
            ?>
            <tr>
              <td colspan="3" style="text-align: center; color: rgba(255,255,255,0.5); padding: 25px;">
                Belum ada data mata pelajaran.
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>