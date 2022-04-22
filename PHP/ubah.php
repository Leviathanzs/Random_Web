<?php
require 'functions.php';

//ambil data di URL
$id = $_GET["id"];

//query data berdasarkan id
$brg = query("SELECT * FROM barang WHERE id = $id")[0];

if (isset($_POST['submit'])) {
    //cek berhasil menambah data atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php'; 
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php'; 
        </script>
    ";
    }
}
?>

<html>

<head>
    <title>Edit Barang</title>
</head>

<body>
    <h1>Ubah Data</h1>
    <a href="index.php">Kembali</a>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $brg["id"]; ?>">
        <input type=" hidden" name="fotoLama" value="<?= $brg["foto"]; ?>">
        <ul>
            <li>
                <label for=" nama">Nama: </label>
                <input type="text" name="nama" id="nama" required value="<?= $brg["nama"]; ?>">
            </li>
            <li>
                <label for="hrg">Harga: </label>
                <input type="text" name="hrg" id="hrg" required value="<?= $brg["hrg"]; ?>">
            </li>
            <li>
                <label for="jml">Jumlah: </label>
                <input type="text" name="jml" id="jml" required value="<?= $brg["jml"]; ?>">
            </li>
            <li>
                <label for="keterangan">Keterangan : </label>
                <input type="text" name="keterangan" id="keterangan" required value="<?= $brg["keterangan"]; ?>">
            </li>
            <li>
                <label for="foto">Foto: </label><br>
                <img src="img/<? $brg['foto']; ?>" width="40"><br>
                <input type="file" name="foto" id="foto">
            </li>
            <li>
                <button type="submit" name="submit">Edit Data</button>
            </li>
        </ul>
    </form>
</body>

</html>