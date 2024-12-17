<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student</title>
  <!-- Css link -->
  <link rel="stylesheet" href="./src/sign.css">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/06aa983bed.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="main">
    <!--SIGNUP PAGE-->
    <div id="signUp">
      <h2 class="head">SignUp</h2>
      <div class="btns">
        <div class="signUp-login-btn">
          <button>SignUp</button>
          <button>Login</button>
        </div>
      </div>
      <form action="#">
        <input type="text" name="user-name" placeholder="Name">
        <input type="email" name="user-email" placeholder="Email Address">
        <input type="password" name="user-pass" placeholder="Password">
        <input type="password" name="user-pass" placeholder="Comfirm password">
        <input type="submit" value="SignUp" id="submitBtn" onclick="event.preventDefault()">
      </form>
      <div class="others">
        <p>allready have an account?  <span> login</span></p>
      </div>
      <div class="bolgtitle1">
      BLOG MANAGEMENT
    </div>
    </div>
    <!--LOGIN PAGE-->
    <div id="login">
      <h2 class="head">Login</h2>
      <div class="btns">
        <div class="signUp-login-btn">
          <button>SignUp</button>
          <button>Login</button>
        </div>
      </div>
      <form action="#">
        <input type="email" name="user-email" placeholder="Email Address">
        <input type="password" name="user-pass" placeholder="Password">
        <span>forget password?</span>
        <input type="submit" value="Login" id="submitBtn" onclick="event.preventDefault()">
      </form>
      <div class="others">
        <p>create an account <span> signUp</span></p>
      </div>
      <div class="bolgtitle">
      BLOG MANAGEMENT
    </div>
    </div>
  
  </div>
<script src="./src/sign.js"></script>
</body>
</html>
