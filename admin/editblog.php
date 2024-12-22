<?php 
session_start();
include '.././src/datacnx.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['EDITart'])){
    $id = $_GET['ideditart'];
    $catg = $_POST['selectCat'];
    $title = $_POST['titleblog'];
    $img = $_POST['lienimage'];
    $desc = $_POST['descrp'];

    if (!empty($catg) && !empty($title) && !empty($img) && !empty($desc)) {
        $updt = "UPDATE `article` SET title='$title',content='$desc',image='$img',categId='$catg' where art_Id = $id";
        var_dump($updt);
        $reslt = mysqli_query($cnx,$updt);
        if ( $reslt) {
             header ('location: ../blog.php');
        } else {
            die("Erreur SQL : " . $cnx->error);
        }
    }
   
}
?>