<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama']; 
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing password
    $level = $_POST['level'];
    
    // Jika role_operator kosong, set NULL
    $role_operator = !empty($_POST['role_operator']) ? $_POST['role_operator'] : NULL;

    // **Upload Foto**
    $foto = "";
    if (!empty($_FILES['foto']['name'])) {
        $foto = "img_" . time() . "_" . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../uploads/" . $foto);
    }

    // Query untuk insert data
    $query = "INSERT INTO user (user_nama, user_username, user_password, user_foto, user_level, role_operator) 
              VALUES ('$nama', '$username', '$password', '$foto', '$level', NULLIF('$role_operator', ''))";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!!');
                window.location.href = 'user.php';
              </script>";
        exit();
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>
