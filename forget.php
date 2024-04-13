<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="forget.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div  class="login-box">
        <div class="login-btn-box">
          <div class="login-btn-color"></div>
          <button  class="login-box-btn" onclick="forgetusername()">Forget username</button><button class="login-box-btn" onclick="forgetpassword()">Change password</button>
        </div>
        <input id="showcheck" type="checkbox">
        <div class="social-icon">
          <i class="fa-brands fa-facebook "></i>
          <i class="fa-brands fa-google "></i>
          <i class="fa-brands fa-instagram"></i>
        </div>
        
        <form id="forget-username"class="input-group" action="">
            <h1 class="singup-heading">Forget username ?</h1>
          
          <input class="singup-input" type="email" placeholder=" Email">
          <div class="password-eye">
              <input class="singup-input" type="password" placeholder=" Password">
              <span  onclick="passwordinput()"class="eye"><img width="40" height="35" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
            </div> 
            <input class="singup-input" type="text" placeholder=" New username">
          <input class="submit2" type="submit"value="Submit">
      </form>
        
        
        <form id="forget-password"class="input-group" action="">
          <h1 class="singup-heading">Forget password ?</h1>
        <input class="singup-input" type="text" placeholder=" Username">
        <input class="singup-input" type="email" placeholder=" Email">
        <div class="password-eye">
            <input class="singup-input" type="password" placeholder=" Old password">
            <span onclick="passwordinput()" class="eye"><img width="40" height="35" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
            </div> 
        <input class="singup-input" type="password" placeholder=" New password">
        <input class="submit" type="submit"value="Submit">
    </form>
<script>
 var passwordInputs = document.querySelectorAll('input[type="password"]');
 var showcheck=document.querySelector("#showcheck");
 var x=document.querySelector("#forget-username");
 var y=document.querySelector("#forget-password");
 var color=document.querySelector(".login-btn-color");
  function forgetpassword(){
    x.style.left="1000px";
    y.style.left="50%";
    color.style.left="50%";
  }
  function forgetusername(){
  y.style.left="1000px";
  x.style.left="50%";
  color.style.left="0px";
  }   
  function passwordinput(){
          showcheck.click();
          if(showcheck.checked){
             passwordInputs.forEach(input => {
             input.type = "text";
           });
          }
          else{
           passwordInputs.forEach(input => {
             input.type = "password";
           });
        }
      }  
</script>
</body> 
</html>