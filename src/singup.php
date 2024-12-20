<?php
require_once './datacnx.php';
// if($_SERVER["REQUEST_METHOD" ] == "POST"){
    $userneme = $_POST['name'];
    $email = $_POST['email'];
    $pssword = $_POST['password'];
    $confirm_pass = $_POST['confirmPassword'];
    $role = 2;
    if($confirm_pass == $pssword){
        $hide = password_hash($pssword, PASSWORD_DEFAULT);
    
    $sql = "insert into user (useId,username,email,password,role_id) values (null,'$userneme','$email','$hide','$role')";
    $data = mysqli_query($cnx,$sql);
    
    if($data){
      var_dump($data);
      header('Location: ../singup.php?alert=Succes');
      echo"data successful!";
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($cnx);
    }
    }else{

        echo "mot pss != conferm pss";
    }
   
// }

?>