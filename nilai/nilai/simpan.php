<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nilai          = $_POST['nilai'];

    $sql = "INSERT INTO siswa (nama, mata_pelajaran, nilai) VALUES (:nama, :mapel, :nilai)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':nama'  => $nama,
        ':mapel' => $mata_pelajaran,
        ':nilai' => $nilai
    ]);

    header("Location: index.php");
    exit();
}
?>