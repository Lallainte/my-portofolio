
<?php

// session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// cek apakah tombol submit sudah pernah dipencet
if ( isset($_POST["submit"]) ) {
   

  

    // cek apakah data berhasil ditambahkan
    if ( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
    ";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data pegawai</title>
    <!-- <link rel="stylesheet" href="css/home.css"> -->
</head>
<body>
    <h1>Tambah data pegawai</h1>

    <form action="" method="post" enctype="multipart/form-data" >
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" for="nama" required >
            </li>
            <li>
                <label for="pendidikan">Pendidikan : </label>
                <input type="text" name="pendidikan" for="pendidikan" required >
            </li>
            <li>
                <label for="posisi">Posisi : </label>
                <input type="text" name="posisi" for="posisi" required >
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" for="email" required >
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" for="gambar" >
            </li>
            <li>
                <button type="submit" name="submit" >Tambah Data!</button>
            </li>
        </ul>

    </form>

</body>
</html>