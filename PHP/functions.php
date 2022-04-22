<?php
$conn = mysqli_connect("localhost", "root", "", "dborder");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['hrg']);
    $jumlah = htmlspecialchars($data['jml']);
    $keterangan = htmlspecialchars($data['keterangan']);

    //upload foto
    $foto = upload();
    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO barang VALUES ('', '$nama', '$harga', '$jumlah', '$keterangan', '$foto')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    //cek apakah tidak ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!')
            </script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar')
            </script>";
        return false;
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar!')
        </script>";
        return false;
    }

    //lolos pengecekan dan siap upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['hrg']);
    $jumlah = htmlspecialchars($data['jml']);
    $keterangan = htmlspecialchars($data['keterangan']);
    $fotoLama = htmlspecialchars($data['fotoLama']);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }

    $foto = htmlspecialchars($data['foto']);

    $query = "UPDATE barang SET nama = '$nama', hrg = '$harga', jml = '$jumlah', keterangan = '$keterangan', foto = '$foto' WHERE id = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $repassword = mysqli_real_escape_string($conn, $data["repassword"]);

    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar!)
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $repassword) {
        echo "<script>
                alert('Password tidak sama!');
            </script>";
        return false;
    }


    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");
    mysqli_affected_rows($conn);
}
