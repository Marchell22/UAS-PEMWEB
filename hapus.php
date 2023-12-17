<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM data WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "<script>alert('Berhasil Menghapus Data!'); window.location.href = 'showdata.php';</script>";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>