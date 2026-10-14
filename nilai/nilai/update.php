<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id             = $_POST['id'];
    $nama           = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nilai          = $_POST['nilai'];

    $sql = "UPDATE siswa SET nama = :nama, mata_pelajaran = :mapel, nilai = :nilai WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':id'    => $id,
        ':nama'  => $nama,
        ':mapel' => $mata_pelajaran,
        ':nilai' => $nilai
    ]);

    header("Location: index.php");
    exit();
}
?>