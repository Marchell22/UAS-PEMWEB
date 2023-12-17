<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000000;
            padding: 10px;
        }

        .logo img {
            height: 100px;
            border-radius: 50px;
            margin-left: 20px;
        }

        .title {
            margin-left: 250px;
        }

        .button-navbar {
            display: flex;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
        }

         button:hover {
            background-color: #ddd;
        }

        .table {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }

        /* Gaya untuk tombol Edit */
        .btn-edit {
            background-color: #28a745; /* Warna hijau untuk tombol Edit */
        }

        /* Gaya untuk tombol Hapus */
        .btn-delete {
            background-color: #dc3545; /* Warna merah untuk tombol Hapus */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="luffy.jpg" alt="Logo">
        </div>
        <div class="title">
            <h1>Welcome To The Page</h1>
        </div>
        <div class="button-navbar">
            <a href="index.php"><button>Halaman Awal</button></a>
            <a href="showdata.php"><button>Informasi Data</button></a>
        </div>
    </div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Browser</th>
                    <th>IP</th>
                    <th>Waktu Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include 'koneksi.php';

                $query = "SELECT * FROM data";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['browser'] . "</td>";
                        echo "<td>" . $row['ip_address'] . "</td>";
                        echo "<td>" . $row['timestamp'] . "</td>";
                        echo "<td>
                        <button class='btn btn-edit' onclick='editAccount(" . $row['id'] . ")'>Edit</button>
                        <button class='btn btn-delete' onclick='confirmDelete(" . $row['id'] . ")'>Hapus</button>
                    </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada produk.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function editAccount(id) {
        // Logika untuk mengarahkan ke halaman edit dengan id tertentu
       window.location.href = 'edit.php?id=' + id;
    }

    function confirmDelete(id) {
        var result = confirm("Apakah Anda yakin ingin menghapus akun ini?");
        if (result) {
            // Redirect atau lakukan tindakan penghapusan di sini, misalnya dengan AJAX atau formulir tersembunyi
            window.location.href = 'hapus.php?id=' + id;
        }
    }
</script>

</html>
