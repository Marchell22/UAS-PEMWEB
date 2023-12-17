<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
        .page-form {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: start;
            height: 100vh;
        }

        #userForm {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
        }

        label {
            display: flex;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="textarea"],
        input[type="date"],
        input[type="radio"] {
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"],
        input[type="textarea"],
        input[type="date"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="button"] {
            width: 48%; /* Adjust the width as needed */
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #111;
            background-color: #fff;
            cursor: pointer;
            margin-right: 4px; /* Add a small margin between buttons */
        }

        input[type="date"]+label,
        input[type="radio"]+label {
            display: inline-block;
            margin-bottom: 12px;
            margin-left: 5px;
        }

        input[type="date"]:checked+label,
        input[type="radio"]:checked+label {
            font-weight: bold;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <?php
        include 'koneksi.php';

        $id = $_GET['id'];

        $query = "SELECT * FROM data WHERE id=$id";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>  
    <div class='page-form'>
        <form id="userForm" action="proses_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>

            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" value="<?php echo $row['nim']; ?>" required><br>

            <label>Jenis Kelamin:</label>
            <input type="radio" id="male" name="gender" value="Laki-Laki" <?php if ($row['gender'] == 'Laki-Laki') echo 'checked'; ?>>
            <label for="male">Laki-Laki</label>
            <input type="radio" id="female" name="gender" value="Perempuan" <?php if ($row['gender'] == 'Perempuan') echo 'checked'; ?>>
            <label for="female">Perempuan</label><br>

            <label for="date">Tanggal Lahir:</label>
            <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required><br>
            
            <label for="address">Alamat:</label>
            <input type="textarea" id="address" name="address" value="<?php echo $row['address']; ?>" required><br>

            <input type="submit" class="button" value="Submit">
            <input type="button" class="button" id="cancelButton" value="Cancel">
        </form>
    <?php
        } else {
            echo "Akun tidak ditemukan.";
        }

        $conn->close();
    ?>
    </div>
</body>
<script>
    document.getElementById("cancelButton").addEventListener("click", function () {
      window.location.href = 'showdata.php';
    });
  </script>
</html>
