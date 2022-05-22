<?php
    require 'fungsi.php';
    if (!isset($_SESSION["pencet"])) {
        header("Location : login.php");
        exit;
    $id = $_GET["id"];
    if ( hapus($id) > 0) {
        echo"
                <script> 
                    alert('berhasil hapus akun');
                    document.location.href ='index.php';
                </script>
            ";
    }
    else {
        
        echo"
                <script> 
                    alert('gagal hapus akun');
                    document.location.href ='index.php';
                </script>
            ";
    }
?>