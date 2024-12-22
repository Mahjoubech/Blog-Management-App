<?php 
include '.././src/datacnx.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addcmnt'])){
    $id = $_GET['cmmEdit'];
    echo $id;
    $artc = $_POST['slctart'];
    $title = $_POST['namecmnt'];
    $updt = "UPDATE `comments` SET article_id='$artc', cmnter='$title' WHERE cmmId='$id' ";
    var_dump($updt);
    $reslt = mysqli_query($cnx,$updt);

    
header('Location: comments.php');
}
?>