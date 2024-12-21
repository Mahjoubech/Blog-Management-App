<?php 
session_start();
include '.././src/datacnx.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edtArt'])){
    $id = $_GET['ideditart'];
    echo $id;
    $user = $_SESSION['user']['useId'];
    $catg = $_POST['editselectCat'];
    $title = $_POST['edittitleblog'];
    $img = $_POST['editlienimage'];
    $desc = $_POST['editdescrp'];

    if (!empty($catg) && !empty($title) && !empty($img) && !empty($desc)) {
        $updt = "UPDATE `article` SET userId='$user',title='$title',content='$desc',image='$img',categId='$catg' where art_Id = $id";
        var_dump($updt);
        $reslt = mysqli_query($cnx,$updt);
        if ( $reslt) {
            header('Location: article.php');
        } else {
            die("Erreur SQL : " . $cnx->error);
        }
    }
   
}
?>