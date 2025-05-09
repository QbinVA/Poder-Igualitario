<?php
require '../config/db.php';

if (isset($_GET['id_noticia'])) {
    $id = $_GET['id_noticia'];
    $sql = "UPDATE publicaciones SET archivada = 1 WHERE id_noticia = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: admin.php");
exit();
?>
