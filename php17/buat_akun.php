<?php  
require 'fungsi.php';

// cek sudah ditekan atau belum
    if (isset($_POST["submit"])) {
       
        

        // cek apakah data berhasil di tambahkan atau tidak
        if (tambah($_POST) > 0) {
            echo"
                <script> 
                    alert('berhasil buat akun');
                    document.location.href ='index.php';
                </script>
            ";
        }else {
            echo " <script> 
            alert('gagal buat akun');
            document.location.href ='index.php';
        </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat akun</title>
</head>
<body>
    <h1>buat akun</h1>
    <form action="" method="post" enctype="multipart/from-data">
    
    <table>
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="ns">Nomer Siswa: </label>
                <input type="text" name="ns" id="ns"required>
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email"required>
            </li>
            <li>
                <label for="jurusan">jurusan : </label>
                <input type="text" name="jurusan" id="jurusan"required>
            </li><li>
                <label for="gambar">gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
               <button type="submit" name="submit">buat akun</button> 
            </li>
        </ul>
    </table>
</form>
</body>
</html>