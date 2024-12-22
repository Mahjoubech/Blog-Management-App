<?php
    session_start();
    require_once('./datacnx.php');

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $getUser = mysqli_query($cnx, "SELECT * FROM user WHERE email = '$email'");
    $resultUser = mysqli_fetch_assoc($getUser);
    
    $Errors = array();
    // check if input email is empty
    if(empty($email)) {
        $Errors[] = 'email';
        $_SESSION['emptyEmail'] = 'email field is required!';
    }

    if(!isset($resultUser)) {
        $Errors[] = 'not';
        $_SESSION['emailNotCorrect'] = 'email is not correct!';
    }

    // check if input password is empty
    if(empty($password)) {
        $Errors[] = 'passs';
        $_SESSION['emptyPassword'] = 'password field is required!';
    }
     

    if(!password_verify($password, $resultUser['password'])) {
        $Errors[] = 1;
        $_SESSION['passNotCorrect'] = 'password is not correct!';

    }
     var_dump($Errors);
     var_dump($_SESSION);
    if(count($Errors) == 0) {
        if($resultUser['role_id'] == 1) {
            $_SESSION['user'] = $resultUser;
            header('location: ../dachboard.php');
            var_dump($Errors);
        } else {
            $_SESSION['user'] = $resultUser;
            header('location: ../blog.php');
        }
    }else{
        echo "error ";
        
    }
?>