<?php

include "../../config/db_conn.php";
include "../../config/url.php";
include "../../config/NamaGambar.php";
//include "../../config/HapusGambar.php";

$act = (isset($_GET['act'])) ? $_GET['act'] : 'none';
$menu = (isset($_GET['menu'])) ? $_GET['menu'] : 'none';
if ($act == 'insert' || $act == 'update') {
    $id_artikel = $_POST['id_artikel'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    if ($act == 'update') {$oldgambar = $_POST['oldgambar'];}
    $gambar = ($_FILES['gambar']['name']);
} else {
    $id = $_GET['id_artikel'];
    $oldgambar = $_GET['oldgambar'];
}

switch ($act) {
    case 'insert':
        $extension = findexts($gambar);
        $NamaGambar = getNamaGambar($gambar, 'artikel');
        if (($extension == "bmp") || ($extension == "gif") || ($extension == "jpg") || ($extension == "jpeg") || ($extension == "png") || ($extension == "pdf") || ($extension == "pNamaGambar")) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], "../../upload/artikel/" . $NamaGambar)) {
                createThumb($gambar, 'artikel', $NamaGambar);
        $query = "INSERT INTO artikel(id_artikel, judul, isi, gambar) VALUES ('$id_artikel', '$judul', '$isi', '$NamaGambar')";
        $sql = mysqli_query($conn,$query) or die("cek : " . $conn->error);
        if ($sql) {
            url("artikel&con=0");
        } else {
            url("artikel&con=1");
        }
        } else {
        echo $query;
                url("artikel&con=9");
            }

        }
        break;
    // case 'update':
    //     $query = "UPDATE users SET password='$password' WHERE username='$username'"; 
    //     $sql = mysqli_query($conn,$query) or die("cek : " . $conn->error);
    //     if ($sql) {
    //         url("artikel&con=2");
    //     } else {
    //         url("artikel&con=3");
    //     }
    //     break;

    // case 'delete':
    //     $query = "DELETE from users where id='$id'";
    //     $sql = mysqli_query($conn,$query) or die("cek : " . $conn->error);
    //     if ($sql) {
    //         url("artikel&con=4");
    //     } else {
    //         url("artikel&con=5");
    //     }
    //     break;
    // default:
    //     break;
}
?>
