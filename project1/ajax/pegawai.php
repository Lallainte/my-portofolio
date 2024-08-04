
<?php 
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM pegawai 
                WHERE 
            nama LIKE '%$keyword%' OR
            pendidikan LIKE '%$keyword%' OR
            posisi LIKE '%$keyword%' OR
            email LIKE '%$keyword%'

    ";
$pegawai = query($query)
?>

<table cellpadding="10" cellspacing="0" border="1"  >
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