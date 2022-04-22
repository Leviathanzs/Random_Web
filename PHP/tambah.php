<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

require 'functions.php';

if (isset($_POST['submit'])) {
    //cek berhasil menambah data atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php'; 
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'index.php'; 
        </script>
    ";
    }
}
?>

<html>

<head>
    <title>Tambah Barang</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <a href="index.php">Kembali</a>
    <form action="" , method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="hrg">Harga: </label>
                <input type="text" name="hrg" id="hrg" required>
            </li>
            <li>
                <label for="jml">Jumlah: </label>
                <input type="text" name="jml" id="jml" required>
            </li>
            <li>
                <label for="keterangan">Keterangan : </label>
                <input type="text" name="keterangan" id="keterangan" required>
            </li>
            <li>
                <label for="foto">Foto: </label>
                <input type="file" name="foto" id="foto" required>
            </li>
            <li>
                <button type="submit" name="submit">Simpan</button>
            </li>
        </ul>
    </form>
</body>

</html>