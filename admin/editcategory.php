<?php 
include '.././src/datacnx.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editcat'])){
    $id = $_GET['idcatgr'];
    echo $id;
    $name = $_POST['nameedit'];
    $updt = "UPDATE `category` SET name='$name' WHERE catId='$id' ";
    var_dump($updt);
    $reslt = mysqli_query($cnx,$updt);

    
header('Location: category.php');
}
?>