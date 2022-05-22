<!-- file handling
tipe input file
tipe form enctype
$_FILES 
move_uploaded_file fungsi-->
<!-- cookie informasi yang bisa diakses di semua halaman informasi disimpan di client web -->
<?php
if (!isset($_SESSION["pencet"])) {
    header("Location : login.php");
    exit;
}
session_start();
// ASC ASCENDING MENGURUTKAN DARI KECIL KEBESAR
// DESC descending mengurutkan dari besar kekecil
    require 'fungsi.php';
  $siswa = query("SELECT * FROM siswa");
  //  tombol cari ditekan
  if ( isset($_POST["cari"]) ) {
    $siswa = cari($_POST["keyword"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">logout</a>
    <h1>daftar siswa</h1>
    <h3><a href="buat_akun.php">buat akun</a></h3>
    <br>
    <form action="" method="post">
        <input type="text" name="keyword" size="96" autofocus placeholder="masukan keyword pencarian" autocomplete="off">
        <button type="submit" name="cari">Cari</button> 
    </form>
    <table border="1" cellpadding="10" cellspacing="0"> <tr>
        <th>id</th>
        <th>aksi</th>
        <th>nama</th> 
        <th>ns</th> 
        <th>email</th> 
        <th>jurusan</th> 
        <th>gambar</th> 
    </tr>
     <?php  $i=1;   ?>
     <?php foreach ($siswa as $si ) {?>
       
     
    <tr>
        
             <td><?= $i ?></td>
             <td>
               <a href="hapus.php?id=<?=$si["id"]?>" onclick="return confirm('yakin hapus akun');">hapus</a>
                |
               <a href="ubah.php?id=<?=$si["id"]?>" onclick="return confirm('yakin ubah akun');">ubah</a>
             </td>
        <td><?=$si["nama"]?></td>
        <td><?=$si["ns"]?></td>
        <td><?=$si["email"]?></td>
        <td><?=$si["jurusan"]?></td>
        <td><img src="a.jpeg" alt="gambar" width="100px"></td>
       
      <?php $i++ ;?>
    </tr> 
    <?php } ?>
    
    </table>
</body>
</html>