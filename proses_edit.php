<?php
include 'koneksi.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $address = $_POST['address'];
   // Mendapatkan jenis browser
function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";

    if (strpos($user_agent, 'MSIE') !== FALSE)
        $browser = 'Internet Explorer';
    elseif (strpos($user_agent, 'Trident') !== FALSE)
        $browser = 'Internet Explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE)
        $browser = 'Microsoft Edge';
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        $browser = 'Mozilla Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        $browser = 'Google Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        $browser = 'Safari';
    elseif (strpos($user_agent, 'Opera') !== FALSE)
        $browser = 'Opera';

    return $browser;
}

// Mendapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

// Periksa apakah itu loopback address
if ($ip_address == "::1" || $ip_address == "127.0.0.1") {
    // Jika loopback, coba dapatkan alamat IP yang valid dari server
    $ip_address = gethostbyname($_SERVER['SERVER_NAME']);
}


// Mendapatkan jenis browser
$browser = getBrowser();


    $query = "UPDATE data SET name='$name', email='$email', nim='$nim', gender='$gender', date='$date', address='$address', browser='$browser', ip_address='$ip_address', timestamp=NOW() WHERE id=$id";

    $result = $conn->query($query);

    if ($result) {
        header("Location: showdata.php");
        exit();
    } else {
        echo "Gagal memperbarui akun: " . $conn->error;
        echo "Query: " . $query;
    }

    $conn->close();
    } else {
    echo "ID tidak ditemukan.";
}
?>