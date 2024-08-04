
<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row =  mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}




// tambah data start
function tambah($data) {
    // ambil data dari tiap elemen form
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $pendidikan = htmlspecialchars($data["pendidikan"]);
    $posisi = htmlspecialchars($data["posisi"]);
    $email = htmlspecialchars($data["email"]);
   
    // upload gambar
    $gambar = upload ();
    if( !$gambar) {
        return false;
    }
    
    
    // query insert data
    $query = "INSERT INTO pegawai
      VALUES
      ('', '$nama', '$pendidikan', '$posisi', '$email', '$gambar')
      ";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
    
}

// upload gambar start

function upload () {
    $namaFile =$_FILES['gambar'] ['name'];
    $ukuranFile =$_FILES['gambar'] ['size'];
    $error =$_FILES['gambar'] ['error'];
    $tmpName =$_FILES['gambar'] ['tmp_name'];

    // cek apakah gambar sudah di upload
    if($error === 4) {
        echo "<script>
                alert('please insert the image!');            
        </script>";
        return false;
    }

    // cek apakah yang di upload itu gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('yang anda upload bukan gambar!');            
        </script>";
        return false;
    }

    // cek ukuran gambar
    if($ukuranFile > 10000000 ) {
        echo "<script>
        alert('ukuran gmabar terlalu besar!');            
        </script>";
        return false;
    }

    // lolos pengecekan
    // generate nama gmabar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru );

    return $namaFileBaru;

}

// upload gambar end
// tambah data end

// hapus data start
function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pegawai WHERE id = $id");
    return mysqli_affected_rows($conn);
}
// hapus data end
// update data start

function update ($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $pendidikan = htmlspecialchars($data["pendidikan"]);
    $posisi = htmlspecialchars($data["posisi"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user milih gambar baru
    if ($_FILES['gambar'] ['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    
    // query insert data
    $query = "UPDATE pegawai SET
                nama = '$nama',
                pendidikan = '$pendidikan',
                posisi = '$posisi',
                email = '$email',
                gambar = '$gambar'
                WHERE id = $id
            ";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

// update data end

// tombol cari start 

function cari ($keyword) {
    $query = "SELECT * FROM pegawai 
                WHERE 
            nama LIKE '%$keyword%' OR
            pendidikan LIKE '%$keyword%' OR
            posisi LIKE '%$keyword%' OR
            email LIKE '%$keyword%'

    ";
    return query($query);
}

// tombol cari END

// registrasi start
    function registrasi($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));  
        $password = mysqli_real_escape_string($conn, $data["password"]); 
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        // cek username duplikat
        $result =  mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");


        if(mysqli_fetch_assoc($result)) {
            echo "<script>
            alert('username sudah ada')
            </script>";
            return false;
        }

        // cek konfirmasi password
        if ($password !== $password2) {
            echo "<script>
                alert ('password tidak sesuai')
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke dalam database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);

    }

// registrasi end

?>