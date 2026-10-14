<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
    header('location:../logout.php');
    exit();
}

include "koneksi.php";

$nis = $_GET['nis'] ?? '';
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
$data = mysqli_fetch_array($query);

if (!$data) {
    header('location:siswa.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Siswa</title>
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
      align-items: center;
      padding: 20px;
      background: linear-gradient(-45deg, #0f172a, #1e1b4b, #311042, #0f172a);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      color: #fff;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Card Glassmorphism */
    .form-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 35px 30px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    }

    .form-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .form-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .form-header p {
      color: rgba(255, 255, 255, 0.6);
      font-size: 0.85rem;
    }

    /* Input Group */
    .input-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.9);
    }

    input[type="text"] {
      width: 100%;
      padding: 12px 14px;
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      background: rgba(255, 255, 255, 0.08);
      color: #fff;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s ease;
    }

    input:focus {
      background: rgba(255, 255, 255, 0.15);
      border-color: #f59e0b;
      box-shadow: 0 0 12px rgba(245, 158, 11, 0.3);
    }

    /* Input NIS Readonly Style */
    input[readonly] {
      background: rgba(255, 255, 255, 0.03);
      color: rgba(255, 255, 255, 0.5);
      border-color: rgba(255, 255, 255, 0.1);
      cursor: not-allowed;
    }

    /* Actions Button */
    .actions {
      display: flex;
      gap: 12px;
      margin-top: 25px;
    }

    .btn {
      flex: 1;
      padding: 12px;
      border-radius: 10px;
      border: none;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-save {
      background: #f59e0b;
      color: white;
    }

    .btn-save:hover {
      background: #d97706;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-cancel {
      background: rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-cancel:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="form-card">
    <div class="form-header">
      <h1>✏️ Edit Data Siswa</h1>
      <p>Ubah informasi siswa di bawah ini</p>
    </div>

    <form action="update.php" method="POST">
      <div class="input-group">
        <label for="nis">NIS (Tidak dapat diubah)</label>
        <input type="text" id="nis" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" readonly>
      </div>

      <div class="input-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required placeholder="Masukkan nama siswa...">
      </div>

      <div class="input-group">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required placeholder="Masukkan alamat...">
      </div>

      <div class="actions">
        <a href="siswa.php" class="btn btn-cancel">Batal</a>
        <button type="submit" class="btn btn-save">Simpan Perubahan</button>
      </div>
    </form>
  </div>

</body>
</html>