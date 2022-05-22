<?php
  // koneksi ke database
  $conn = mysqli_connect("localhost", "root","","belajar_php");

  function query($query){
    global $conn;
    $result=mysqli_query($conn, $query);
    $sis =[];
    while ($si =mysqli_fetch_assoc($result)) {
      $sis[]= $si;
    }
    return $sis;
  }
  function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $ns = htmlspecialchars($data["ns"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    
    // upload gambar
    $gambar = upload();
    if( !$gambar){
        return false;
    }
    // query insert data
    $query = "INSERT INTO siswa VALUES 
        ('','$nama', '$ns', '$email', '$jurusan', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa where id=$id");
    return mysqli_affected_rows($conn);
  }
  function ubah($data){
    global $conn;
    $id =$data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $ns = htmlspecialchars($data["ns"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $gambar = htmlspecialchars($data["gambar"]);
    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
      $gambar = upload();
    }
    // query insert data
    $query = "UPDATE  siswa SET 
              nama = '$nama',
              ns= '$ns',
              email = '$email',
              jurusan = '$jurusan',
              gambar ='$gambar'
              WHERE id = $id
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
  function upload(){


      $namaFile = $_FILES['gambar']['name'];
      $ukuranFile = $_FILES['gambar']['size'];
      $eror = $_FILES['gambar']['error'];
      $tmpName = $_FILES['gambar']['tmp_name'];

      //  cek apakah tidak ada gambar yang diupload
      if ( $error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
                </script>";
            return false;
      }
      // cek apakah yang diupload adalah gambar
      $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
                </script>";
      }

      //  cek jika ukuran terlalu besar
      if ( $ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran terlalu besar');
                </script>";
      }
      // generate nama gambar baru
      $namaFileBaru = uniqid();
      $namaFileBaru .='.';
      $namaFileBaru .= $ekstensiGambar;


      // gambar siap diupload 
      move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
      return $namaFileBaru;

  }
  function cari($keyword){
    $query = "SELECT * FROM siswa
               WHERE  
              nama LIKE '%$keyword%' OR
              ns LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%' OR
              email LIKE '%$keyword%' 
              ";
              // menambahkan keyword query LIKE memunculkan data yang mirip tidak harus sama persis
              // menambahkan % untuk inisial didepan untuk mencari inisial belakang
              // menambahkan % untuk inisial dibelakang untuk mencari inisial depan
          return query($query);
  }
  function registrasi($data){
    global $conn;
    // fungsi strtolower mengubah string huruf besar menjadi huruf kecil
    // fungsi stripslashes menghilangkan tanda miring
    $username =strtolower(stripslashes($data["username"]));
    // mysqli_real_escape_string(); berfungsi untuk memasukan string yang terdapat simbol kutip agar aman masuk di database
    $password =mysqli_real_escape_string($conn, $data["password"]) ;
    $password2 =mysqli_real_escape_string($conn, $data["password2"]) ;

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
              alert('username yang dipilih sudah terdaftar');
              </script>";
              return false;
    }
    
    // cek konfirmasi password
    if( $password !== $password2 ){
      echo"<script>
              alert('konfirmasi password tidak sesuai');
              </script>";
              return false;
    }
    // return 1;
    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);
    // tambahkan userbaru ke database
      mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
    // $password = md5($password);
    // var_dump($password); die;
    // tambahkan userbaru ke database
    

   return mysqli_affected_rows($conn);
  }
?>