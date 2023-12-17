<?php
session_start();

// Mendapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

// Periksa apakah itu loopback address
if ($ip_address == "::1" || $ip_address == "127.0.0.1") {
    // Jika loopback, coba dapatkan alamat IP yang valid dari server
    $ip_address = gethostbyname($_SERVER['SERVER_NAME']);
}

// Gunakan $ip_address sesuai kebutuhan, contohnya simpan dalam session
$_SESSION['user_ip'] = $ip_address;

// Cetak atau gunakan $ip_address sesuai kebutuhan

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet">
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

        .page-form {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: start;
            /* text-align: center; */
            height: 100vh;
            /* Adjust the height as needed */
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

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #111;
            background-color: #fff;
            cursor: pointer;
        }

        /* Add styling for date and radio labels */
        input[type="date"]+label,
        input[type="radio"]+label {
            display: inline-block;
            margin-bottom: 12px;
            margin-left: 5px;
        }

        /* Optional: Style for checked state of date and radio */
        input[type="date"]:checked+label,
        input[type="radio"]:checked+label {
            font-weight: bold;
            color: #0066cc;
        }
        button:hover {
            background-color: #ddd;
        }
        .ipAddress {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
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
    <div id="ipAddress" class="ip"><?php echo "IP Address Pengguna: " . $ip_address; ?></div>
    </div>
    <div class='page-form'>
        <form id="userForm" action="tambah_data.php" method='post'>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" required><br>

            <label>Jenis Kelamin:</label>
            <input type="radio" id="male" name="gender" value="Laki-Laki">
            <label for="male">Laki-Laki</label>
            <input type="radio" id="female" name="gender" value="Perempuan">
            <label for="female">Perempuan</label><br>

            <label for="date">Tanggal Lahir:</label>
            <input type="date" id="date" name="date" required><br>
            
            <label for="address">Alamat:</label>
            <input type="textarea" id="adress" name="address" required><br>

            <input type="submit" class="button" value="Submit">
        </form>
    </div>

</body>
<script>
     function validateForm() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var nim = document.getElementById('nim').value;
        var gender = document.querySelector('input[name="gender"]:checked');
        var date = document.getElementById('date').value;
        var address = document.getElementById('address').value;

        clearErrors();

        var isValid = true;

        if (!name) {
            displayError('nameError', 'Nama harus diisi');
            isValid = false;
        }

        if (!email || !isValidEmail(email)) {
            displayError('emailError', 'Email tidak valid');
            isValid = false;
        }

        if (!nim) {
            displayError('nimError', 'NIM harus diisi');
            isValid = false;
        }

        if (!gender) {
            displayError('genderError', 'Jenis Kelamin harus dipilih');
            isValid = false;
        }

        if (!date) {
            displayError('dateError', 'Tanggal Lahir harus diisi');
            isValid = false;
        }

        if (!address) {
            displayError('addressError', 'Alamat harus diisi');
            isValid = false;
        }

        return isValid;
    }
    // Fungsi untuk menetapkan cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
               date.setTime(date.getTime() + (1 * 10 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Fungsi untuk mendapatkan nilai cookie berdasarkan nama
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // Fungsi untuk menghapus cookie berdasarkan nama
        function eraseCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999;';
        }

        // Fungsi untuk menyimpan data ke local storage
        function setLocalStorage(key, value) {
            localStorage.setItem(key, JSON.stringify(value));
        }

        // Fungsi untuk mendapatkan data dari local storage
        function getLocalStorage(key) {
            var value = localStorage.getItem(key);
            return value ? JSON.parse(value) : null;
        }

        // Fungsi untuk menghapus data dari local storage
        function removeLocalStorage(key) {
            localStorage.removeItem(key);
        }

        // Fungsi untuk mendapatkan alamat IP pengguna
        function getUserIP(onIPReceived) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    onIPReceived(this.responseText);
                }
            };
            xhttp.open("GET", "https://api64.ipify.org?format=json", true);
            xhttp.send();
        }

        // Fungsi untuk menampilkan alamat IP pada halaman
        function displayIPAddress(ip) {
            document.getElementById("ipAddress").innerHTML = "IP Address Pengguna: " + ip;
        }
        // Panggil fungsi untuk mendapatkan alamat IP
        getUserIP(function (ip) {
            displayIPAddress(ip);
        });

        // Contoh penggunaan
        setCookie('username', 'Marcho Manurung', 7);
        console.log('Cookie Username:', getCookie('username'));

        setLocalStorage('user', { name: 'Marchell Manurung', age: 21 });
        console.log('Local Storage User:', getLocalStorage('user'));

        eraseCookie('username');
        removeLocalStorage('user');
    </script>
</script>

</html>