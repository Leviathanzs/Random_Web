<?php
require 'functions.php';

if (isset($_POST['register'])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
                    alert('User baru berhasil ditambahkan!')
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<html>

<head>
    <title>Halaman Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Regristasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="repassword">Konfirmasi Password: </label>
                <input type="password" name="repassword" id="repassword">
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>

</html>