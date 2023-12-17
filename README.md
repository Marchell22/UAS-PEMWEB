Bagian 1: Client-side Programming (Bobot: 30%)

1.1 (15%) Buatlah sebuah halaman web sederhana yang memanfaatkan JavaScript untuk melakukan manipulasi DOM.

Panduan:
- Buat form input dengan minimal 4 elemen input (teks, checkbox, radio, dll.)
   Elemen Input menggunakan type text, email, radio, date dan submit berada pada file index.php dengan dibungkus menggunakan tag div dengan class="page-form"
- Menampilkan data dari server kedalam sebuah halaman menggunakan tag `table`
  Tag Table digunakan pada file showdata.php pada div dengan class="table". Proses menampilkan data menggunakan php dengan menggunakan Query dari "Select * From data"; Data tersebut akan ditampilkan pada tag table.

1.2 (15%) Buatlah beberapa event untuk menghandle interaksi pada halaman web

Panduan:
- Tambahkan minimal 3 event yang berbeda untuk menghandle form pada 1.1
  * Fungsi Pemanggilan dengan menggunakan validateForm() pada file index.php yang berfungsi untuk ketika inputan tidak diisi maka muncul alert error
  * Fungsi pemanggilan menggunakan id pada file showdata.php berfungsi untuk mengarahkan pemrosesan menggunakan dengan menggunakan id dari data dan diarahkan kepada file lain yang terhubung dengan menyimpan id dari data tersebut
  * Fungsi pemanggilan menggunakan addEventListener pada file edit.php berfungsi ketika button cancel pada file edit.php akan dipanggil jika button tersebut diklik
- Implementasikan JavaScript untuk validasi setiap input sebelum diproses oleh PHP
  Penggunaan Javascript untuk memvalidasi inputan dari form pada file index.php yang akan menvalidasi bahwa semua inputan tidak kosong
Bagian 2: Server-side Programming (Bobot: 30%)

2.1 (20%) Implementasikan script PHP untuk mengelola data dari formulir pada Bagian 1 menggunakan variabel global seperti `$_POST` atau `$_GET`. Tampilkan hasil pengolahan data ke layar.

Panduan:
- Gunakan metode POST atau GET pada formulir.
  Penggunaan METHOD = "POST" pada file index.php pada div class="page-form" metode POST adalah salah satu metode HTTP yang digunakan untuk mengirimkan data dari formulir ke server. data akan dikirimkan kebagian file dari tambah_data.php dan akan diproses ke database menggunakan php
- Parsing data dari variabel global dan lakukan validasi disisi server
- Simpan ke basisdata termasuk jenis browser dan alamat IP pengguna
  Proses ini akan dijalankan pada file dataHandler.php yang berfungsi untuk mendapatkan alamat IP dari pengguna dan jenis browser yang digunakan untuk melakukan penginputan pada form halaman awal

2.2 (10%) Buatlah sebuah objek PHP berbasis OOP yang memiliki minimal dua metode dan gunakan objek tersebut dalam skenario tertentu pada halaman web Anda.

Panduan:
- Objek yang dibuat harus terkait dengan konteks pengembangan web saat ini.
  * Menggunakan Methode Class yaitu Class DataHandler Representasi dari sebuah entitas yang memiliki properti (variabel) dan metode (fungsi). Objek ($dataHandler): Instansiasi dari kelas DataHandler. Dengan membuat objek, kita dapat menggunakan properti dan metode yang didefinisikan dalam kelas.
  * Menggunakan Konstruktor Fungsi __construct: Ini adalah metode khusus yang akan dijalankan secara otomatis setiap kali objek dibuat. Pada contoh ini, konstruktor menerima parameter $conn yang merupakan koneksi database.
  * Menggunakan Metode Enkapsulasi Properti private $conn: Menunjukkan enkapsulasi dengan mendeklarasikan properti sebagai private. Properti private hanya dapat diakses dari dalam kelas tersebut.
  * Menggunakan Exception Handling Pada konstruktor, terdapat penggunaan throw new Exception untuk menghasilkan exception jika koneksi database tidak valid. Ini memastikan bahwa kondisi tidak valid dapat ditangani secara elegan dengan exception.

Bagian 3: Database Management (Bobot: 20%)

3.1 (5%) Buatlah sebuah tabel pada database MySQL

Panduan:
- Lampirkan langkah-langkah dalam membuat basisdata dengan syntax basisdata
Menjalankan database pada phpmyadmin dengan menjalankan software xampp. Kemudian pada localhost:8080/phpmyadmin kita menjalankan database dengan membuat sebuah database dengan bernama "uaspemweb". Kemudain membuat stuktur tabel
Struktur dari tabel `data`


CREATE TABLE `data` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




INSERT INTO `data` (`id`, `name`, `nim`, `gender`, `date`, `address`, `email`, `browser`, `ip_address`, `timestamp`) VALUES
(7, 'Chell', '120', 'Perempuan', '2023-12-25', 'Porsea', 'ramotmanurung424@gmail.com', 'Google Chrome', '127.0.0.1', '2023-12-16 16:31:24');


ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;



3.2 (5%) Buatlah konfigurasi koneksi ke database MySQL pada file PHP. Pastikan koneksi berhasil dan dapat diakses.

Panduan:
- Gunakan konstanta atau variabel untuk menyimpan informasi koneksi (host, username, password, nama database).
  Dijalankan pada file koneksi.php untuk dapat terhubung ke dalam server local
  <?php
$host = "localhost";
$username = "root";
$password = "";
$database = "uaspemweb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>

3.3 (10%) Lakukan manipulasi data pada tabel database dengan menggunakan query SQL. Misalnya, tambah data, ambil data, atau update data.

Panduan:
- Gunakan query SQL yang sesuai dengan skenario yang diberikan.
- Pemrosesan tambah data berada pada file tambah_data.php, untuk mengambil data berada pada file showdata.php dan melakukan update data pada file edit.php

Bagian 4: State Management (Bobot: 20%)
4.1 (10%) Buatlah skrip PHP yang menggunakan session untuk menyimpan dan mengelola state pengguna. Implementasikan logika yang memanfaatkan session.

Panduan:
- Gunakan `session_start()` untuk memulai session.
- Simpan informasi pengguna ke dalam session.
  Penggunanaan Fungsi session_start() adalah fungsi dalam PHP yang digunakan untuk memulai atau melanjutkan sesi pengguna. Sesi adalah cara untuk menyimpan data pengguna di antara beberapa permintaan halaman web. Dengan menggunakan sesi, Anda dapat menyimpan variabel-variabel yang dapat diakses di seluruh halaman web selama sesi berlangsung. Fungsi session start pada website ini yaitu untuk mengambil ip dari pengguna dan akan ditampilkan pada halaman awal website

4.2 (10%) Implementasikan pengelolaan state menggunakan cookie dan browser storage pada sisi client menggunakan JavaScript.

Panduan:
- Buat fungsi-fungsi untuk menetapkan, mendapatkan, dan menghapus cookie.
- Gunakan browser storage untuk menyimpan informasi secara lokal.
  Terdapat pada file dari index.php 
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

Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)
Bagian bonus ini akan memberikan bobot tambahan 20% jika Anda berhasil meng-host aplikasi web yang Anda buat. Jawablah pertanyaan-pertanyaan berikut:

(5%) Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
Langkah pertama yaitu login kepada website dari infinityfree kemudian lanjut ke tahap Create Account. Selanjutnya masuk ke dalam bagian Hosting Plan untuk memilih jenis hosting yang digunakan kemudian menentukan sub domain yang digunakan, kemudian melakukan additional information selanjutnya masuk ke dalam cpanel untuk mengupload file dari web. Ketika di cpanel kita masuk ke dalam online file manager dan masuk ke dalam folder htdocs dan mengupload file web. Kemudian masuk lagi ke dalam cpanel lalu masuk ke dalam MySQL Database untuk mendapatkan host username dan nama database dari infinityfree, kemudian kita memasukkan struktur tabel pada database cpanel.

(5%) Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda. Berikan alasan Anda.
 InfinityFree menawarkan layanan hosting gratis. Ini bisa menjadi pilihan yang baik untuk mereka yang memiliki anggaran terbatas atau yang baru memulai dan ingin mencoba hosting tanpa biaya.

(5%) Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
Ketersediaan pembaruan keamanan mungkin tidak secepat pada layanan hosting berbayar. Ini dapat meningkatkan risiko terhadap eksploitasi kerentanan keamanan yang telah diperbaiki dalam pembaruan.

(5%) Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
detail konfigurasi server pada penyedia hosting gratis seperti InfinityFree mungkin terbatas atau tidak sepenuhnya diungkapkan kepada pengguna karena sifat shared hosting dan pengelolaan penuh server oleh penyedia hosting.
* InfinityFree menggunakan model shared hosting, yang berarti beberapa situs web dihosting pada satu server fisik. Ini membatasi kontrol penuh atas konfigurasi server untuk setiap pengguna.
*InfinityFree umumnya menyediakan server web Apache, yang dapat dikonfigurasi untuk mendukung berbagai bahasa pemrograman dan kerangka kerja seperti PHP.
*InfinityFree biasanya mendukung server database MySQL untuk menyimpan dan mengelola data aplikasi web.
