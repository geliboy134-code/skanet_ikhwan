<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] <> "sukses") {
    header('location:logout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Utama - Sistem Informasi Nilai</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Background Gradient Animasi */
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

    /* Container Glassmorphism */
    .dashboard-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 8px;
      letter-spacing: 0.5px;
    }

    .subtitle {
      color: rgba(255, 255, 255, 0.6);
      font-size: 0.9rem;
      margin-bottom: 30px;
    }

    /* Grid Layout untuk Menu Cards */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-bottom: 25px;
      list-style: none; /* Menghilangkan titik (bullet) bawaan <li> */
    }

    .menu-item {
      display: block;
    }

    .menu-link {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px 15px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 12px;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .menu-link:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: rgba(255, 255, 255, 0.3);
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .menu-icon {
      font-size: 1.8rem;
      margin-bottom: 8px;
    }

    /* Tombol Logout */
    .logout-container {
      list-style: none;
      margin-top: 10px;
    }

    .btn-logout {
      display: block;
      width: 100%;
      padding: 12px;
      background: rgba(10, 248, 105, 0.2);
      border: 1px solid rgba(16, 243, 243, 0.4);
      border-radius: 10px;
      color: #1afc9e;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    .btn-logout:hover {
      background: #1cf865;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    }
  </style>
</head>
<body>

  <div class="dashboard-card">
    <h1>Menu Utama</h1>
    <p class="subtitle">Sistem Informasi Akademik & Nilai</p>

    <ul class="menu-grid">
      <li class="menu-item">
        <a href="siswa" class="menu-link">
          <span class="menu-icon">👨‍🎓</span>
          <span>Siswa</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="guru" class="menu-link">
          <span class="menu-icon">👩‍🏫</span>
          <span>Guru</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="mapel" class="menu-link">
          <span class="menu-icon">📚</span>
          <span>Mapel</span>
        </a>
      </li>
      <li class="menu-item">
        <a href="nilai" class="menu-link">
          <span class="menu-icon">📊</span>
          <span>Nilai</span>
        </a>
      </li>
    </ul>

    <ul class="logout-container">
      <li>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </li>
    </ul>
  </div>

</body>
</html>