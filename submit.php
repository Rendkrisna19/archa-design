<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root"; // Ganti sesuai dengan username database Anda
$password = "";     // Ganti sesuai dengan password database Anda
$database = "orders";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO messages (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Menampilkan alert dan mengarahkan kembali ke halaman utama
        echo "<script>
                alert('Pesan Anda berhasil dikirim!');
                window.location.href = 'index.html';
              </script>";
        exit();
    } else {
        // Menampilkan pesan error
        echo "<script>
                alert('Terjadi kesalahan: " . $conn->error . "');
              </script>";
    }

    $conn->close();
}
?>
