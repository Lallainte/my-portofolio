

<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$pgw = query("SELECT * FROM pegawai WHERE id = $id") [0];

// cek apakah tombol submit sudah pernah dipencet
if ( isset($_POST["submit"]) ) {
   

  

    // cek apakah data berhasil diubah
    if ( update($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
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
    <title>Update data pegawai</title>
</head>
<body>
    <h1>Update data pegawai</h1>

    <form action="" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?= $pgw["id"]; ?>" >
        <input type="hidden" name="gambarLama" value="<?= $pgw["gambar"]; ?>" >
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" for="nama" required value="<?= $pgw["nama"] ?>" >
            </li>
            <li>
                <label for="pendidikan">Pendidikan : </label>
                <input type="text" name="pendidikan" for="pendidikan" required value="<?= $pgw["pendidikan"] ?>"  >
            </li>
            <li>
                <label for="posisi">Posisi : </label>
                <input type="text" name="posisi" for="posisi" required value="<?= $pgw["posisi"] ?>"  >
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" for="email" required value="<?= $pgw["email"] ?>"  >
            </li>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img src="img/<?= $pgw['gambar']; ?>" width="50" > <br>
                <input type="file" name="gambar" for="gambar"  >
            </li>
            <li>
                <button type="submit" name="submit" >Update Data!</button>
            </li>
        </ul>

    </form>

</body>
</html>