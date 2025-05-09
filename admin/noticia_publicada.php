<?php
require '../config/db.php';

// Seleccionar solo noticias que están publicadas y no archivadas
$sql = "SELECT id, titulo, fecha, autor FROM noticias WHERE publicada = 1 AND archivada = 0 ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

$noticias = [];

while ($fila = $resultado->fetch_assoc()) {
    $noticias[] = $fila;
}

echo json_encode($noticias);

$conexion->close();
?>
