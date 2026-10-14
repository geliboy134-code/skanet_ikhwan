<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Nilai Siswa</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
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
    .form-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 16px;
      padding: 30px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    h3 { margin-bottom: 20px; text-align: center; }
    .form-group { margin-bottom: 15px; }
    label { display: block; margin-bottom: 6px; font-size: 0.9rem; }
    input {
      width: 100%;
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      outline: none;
    }
    input:focus { border-color: #3b82f6; background: rgba(255, 255, 255, 0.15); }
    .actions { display: flex; gap: 10px; margin-top: 20px; }
    .btn {
      flex: 1;
      padding: 10px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      text-align: center;
      text-decoration: none;
    }
    .btn-save { background: #10b981; color: white; }
    .btn-cancel { background: rgba(255, 255, 255, 0.2); color: white; }
  </style>
</head>
<body>

  <div class="form-card">
    <h3>Tambah Nilai Siswa</h3>
    <form action="simpan.php" method="POST">
      <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" name="nama" required placeholder="Masukkan nama...">
      </div>
      <div class="form-group">
        <label>Mata Pelajaran</label>
        <input type="text" name="mata_pelajaran" required placeholder="Contoh: Matematika">
      </div>
      <div class="form-group">
        <label>Nilai (0 - 100)</label>
        <input type="number" name="nilai" min="0" max="100" required placeholder="85">
      </div>
      <div class="actions">
        <a href="index.php" class="btn btn-cancel">Batal</a>
        <button type="submit" class="btn btn-save">Simpan</button>
      </div>
    </form>
  </div>

</body>
</html>