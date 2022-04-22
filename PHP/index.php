<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
//koneksi database
require 'functions.php';
$barang = query("SELECT * FROM barang");

?>

<html>

<head>
    <title>UTS</title>
</head>

<body>
    <h1>Daftar Barang</h1>
    <a href="logout.php">Logout</a><br>
    <a href="tambah.php">Tambah Barang</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($barang as $row) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["hrg"]; ?></td>
                <td><?= $row["jml"]; ?></td>
                <td><?= $row["keterangan"]; ?></td>
                <td><img src="img/<?= $row["foto"]; ?>" width="100px" height="100px"></td>
                <td>
                    <a href="ubah.php?id=<?= $row["id"]; ?>">Edit ||</a>
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>