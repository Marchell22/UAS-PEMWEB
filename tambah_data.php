<?php
include 'koneksi.php';
include 'dataHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataHandler = new DataHandler($conn);

    // Mendapatkan nilai dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $address = $_POST['address'];

    // Validasi input (contoh validasi email)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.location.href = 'index.php';</script>";
        exit();
    }

    // Memanggil metode addData dari objek DataHandler
    if ($dataHandler->addData($name, $email, $nim, $gender, $date, $address)) {
        echo "<script>alert('Berhasil Menambahkan Data!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal Menambahkan Data!'); window.location.href = 'index.php';</script>";
    }
}

$conn->close();
?>
