<?php
session_start();
  // // sesion adalah cara pemberi atau menerima data untuk berbagai halaman dan data disimpan di server
    // $_SESSION
    // // syarat penggunaan variabel global sesion adalah session_start() disetiap halaman
    // nilai sesion akan hilang saat satu sesi browser di close/komputer di restart
    // session_destroy() untuk menghapus / memberhentikan sesi
    require 'fungsi.php';
    // 
    if (isset($_COOKIE['pencet'])) {
        if ($_COOKIE['pencet'] == true) {
            $_SESSION["pencet"] = true;
        }
    }

    if (isset($_POST["pencet"])) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE
            username = '$username'");

            // cek username
            if (mysqli_num_rows($result) === 1 ) {
                // cek password
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row["password"]) ){
                    // set session
                    $_SESSION["pencet"] = true;

                    // cek ingat aku
                    if (isset($_POST["ingat"])) {
                        // buat cookie
                        setcookie('id', $row['id'], time() +60*60*24);
                        setcookie('key', hash('sha256', $row['username']),time() +60*60*24);
                        
                    }

                    header("Location : index.php");
                    exit;
                }
            }
            $salah = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="gaya.css">
</head>
<body>
    <?php if (isset($salah)) {?>
        <p>username / password salah</p>
    <?php }?>
    <h1>Halaman Login</h1>

    <form action="" method="post">

    <ul>
        <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username">
        </li>
        <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
        </li>
            <label for="ingat">ingat aku</label>
            <input type="checkbox" name="ingat" id="ingat">
        <li>
        <button type="submit" name="pencet">masuk akun</button></li>
    </ul>
    </form>
</body>
</html>