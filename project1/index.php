
<?php 

// session_start();

if(!isset($_SESSION["login"])) {
    header( "Location: login.php");
    exit;
}


require 'functions.php';
$pegawai = query("SELECT * FROM pegawai ORDER BY id DESC ");

// tombol cari ditekan start
if(isset($_POST["cari"])) {
    $pegawai = cari ($_POST["keyword"]);
};

// tombol cari ditekan end


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <!-- <style>
        span {
            font-weight: bold;
            font-style: italic;
            color: royalblue;
        }

    </style> -->
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<!-- navbar start -->
<header class="header-container">
      <section class="logo-icon"></section>
      <section class="nav-container">
      <a href="logout.php">Logout</a>
      <a href="tambah.php">Tambah data pegawai</a>
        <a href="#calls-us" >Calls Us</a>
      </section>
    </header>
    <hr />
<!-- navbar end -->
       
<section>
    <h1>Daftar Pegawai <span>M</span> Corp</h1>
</section>

<div>
<form action="" method="post" >

        <input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian.." autocomplete="off" id="keyword" >
        <button type="submit" name="cari" id="tombol-cari" >Cari!</button>

</form>
    <br>

<div id="container" >
    <table class="table" cellpadding="10" cellspacing="0" border="1"  >
        <tr>
            <th>NO.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Pendidikan Terakhir</th>
            <th>Posisi</th>
            <th>Email</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $pegawai as $row ) : ?>

        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="update.php?id=<?= $row["id"] ; ?>">Update</a>
                <a href="hapus.php?id=<?= $row["id"] ; ?>" onclick="return confirm('apakah anda yakin untuk menghapus data tersebut? ');" >Hapus</a>
            </td>
            <td><img src="img/<?= $row["gambar"] ; ?>"  width="50" height="60" ></td>
            <td><?= $row["nama"] ; ?></td>
            <td><?= $row["pendidikan"] ; ?></td>
            <td><?= $row["posisi"] ; ?></td>
            <td><?= $row["email"] ; ?></td>
        </tr>
        <?php $i++; ?>
        <?php  endforeach; ?>

    </table>
</div>
</div>
<script src="js/jquery-3.7.1.min.js" ></script>
<script src="js/script.js" ></script>
</body>
</html>