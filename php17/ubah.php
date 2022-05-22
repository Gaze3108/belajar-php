<?php  
require 'fungsi.php';
if (!isset($_SESSION["pencet"])) {
    header("Location : login.php");
    exit;
// ambil data di URL
$id = $_GET["id"];
//  query data siswa berdasarkan id
$si = query("SELECT * FROM siswa where id = $id")[0];

// cek sudah ditekan atau belum
    if (isset($_POST["submit"])) {
       
        // cek apakah data berhasil di tambahkan atau tidak
        if ( ubah($_POST) > 0) {
            echo"
                <script> 
                    alert('berhasil diubah akun');
                    document.location.href ='index.php';
                </script>
            ";
        }else {
            echo " <script> 
            alert('gagal diubah akun');
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
    <title>ubah data siswa</title>
</head>
<body>
    <h1>ubah data siswa</h1>
    <form action="" method="post" enctype="mutipart/form-data">
    <!-- input type hidden mengirim data tanpa ketahuan user -->
    <table>
        <ul>
            <input type="hidden" name="id" value="<?= $si["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $si["gambar"]; ?>">
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required value="<?= $si["nama"];?>">
            </li>
            <li>
                <label for="ns">Nomer Siswa: </label>
                <input type="text" name="ns" id="ns"required
                value="<?= $si["ns"];?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email"required value="<?= $si["email"];?>">
            </li>
            <li>
                <label for="jurusan">jurusan : </label>
                <input type="text" name="jurusan" id="jurusan"required value="<?= $si["jurusan"];?>">
            </li><li>
                
                <label for="gambar">gambar : </label>
                <img src="img/<?= $si["gambar"];?>" alt=""> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
               <button type="submit" name="submit">ubah data</button> 
            </li>
        </ul>
    </table>
</form>
</body>
</html>