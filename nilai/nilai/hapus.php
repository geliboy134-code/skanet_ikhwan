<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM siswa WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: index.php");
exit();
?>