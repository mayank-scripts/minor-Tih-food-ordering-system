<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<?php
  include("ccc.php");
session_start();
class usermob{
  public $conn;
public function __construct(){
  global $database;
  $this ->conn=$database->db;
}
public function loginmob() {
  if (isset($_POST["loginmob"])) {
      if (empty($_POST["username"]) || empty($_POST["password"])) {
          $message = '<label>All fields are required</label>';
      } else {
          $query = "SELECT * FROM users WHERE uname=:username AND password=:password";

          $statement = $this->conn->prepare($query);
          $statement->execute(
              array(
                  'username' => $_POST["username"],
                  'password' => md5($_POST["password"])
              )
          );

          $row = $statement->fetch(PDO::FETCH_ASSOC);

          if ($row) {
              $_SESSION["uid"] = $row["uid"];
              $_SESSION["username"] = $row["uname"];
              header("location:index.php");
              
          } else {
            $fmessage = "<div class='alert-wrapper failed'>
            <p class='alert failed'>Failed account not Logged in check username or password. <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
            echo $fmessage;
          }
      }
  }
}

          
      
  


function signupmob(){
  if(isset($_POST["signupmob"]))
  {
      if(empty($_POST["username"]) || empty($_POST["password"]))
  {
    $message='<label>all field is requird</label>';
  }
  else
  {
    $query="SELECT * FROM users WHERE uname=:username";
$result= $this->conn->prepare($query);  
$result->execute(array('username' => $_POST["username"]));
$count = $result->rowCount();
   if($count>0) {
    $smessage = "<div class='alert-wrapper failed'>
    <p class='alert failed'>username already exist <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
    echo $smessage;

   }
   else {
    $sql = "INSERT INTO `users` (uid, uname, email, password,phone,address,pincode) VALUES (NULL, :username, :email, :password,:phone,:address,:pincode);";
    $sqlresult= $this->conn->prepare($sql);
    $sqlresult->execute(array("username"=>$_POST["username"],"email"=>$_POST["email"],"password"=>md5($_POST["password"]),"phone"=>NULL,"address"=>NULL,"pincode"=>NULL));
    echo '<script>relocate();</script>';
   }

    }
}
}
}
$user=new usermob();
$user->loginmob();
$user->signupmob();
?>
    <div  class="login-box">
        <div class="login-btn-box">
          <div class="login-btn-color"></div>
          <button id="login-nav-btn" class="login-box-btn" onclick="login()">Login</button><button class="login-box-btn" onclick="singup()">Signup</button>
        </div>
        <div class="social-icon">
          <i class="fa-brands fa-facebook "></i>
          <i class="fa-brands fa-google "></i>
          <i class="fa-brands fa-instagram"></i>
        </div>
        
        <form id="login2" method='POST' class="input-group" action="">
              <h1 class="login-heading">Login</h1>
            <input class="input2" name='username' type="text" placeholder=" Username"required>
            <div class="password-eye">
            <input  class="input2"name='password' type="password" placeholder=" password"required pattern=".{8,}">
            <span  onclick="passwordinput()"class="eye"><img width="35" height="30" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
          </div>
            <input type="checkbox" class="check-box"><span>Remember password</span>
            <input class="submit-login"name='loginmob' type="submit"value="Submit">
        </form>
        
        
        <form id="singup" method='POST' class="input-group" action="">
          <h1 class="singup-heading">Signup</h1>
        <input class="singup-input"name='username' type="text" placeholder=" Username"required>
        <input class="singup-input" name='email'type="email" placeholder=" Email"required>
        <div class="password-eye">
            <input class="input2" name='password' type="password" placeholder=" password"required pattern=".{8,}">
            <span onclick="passwordinput()" class="eye"><img width="35" height="30" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
          </div>
        <input class="singup-input" type="password" placeholder=" Confirm Password"required pattern=".{8,}">
        <input class="submit"name='signupmob' type="submit"value="Submit">
    </form>
         

     

    </div>
    <script>
      
      var user=document.querySelector("#forget-username");
      var pass=document.querySelector("#forget-password");
      var x=document.querySelector("#login2");
      var y=document.querySelector("#singup");
      var color=document.querySelector(".login-btn-color");
     
        function singup(){
          x.style.left="1000px";
          y.style.left="50%";
          // y.style.transform="translateX(-50%)";
          color.style.left="50%";
        }
        function login(){
          y.style.left="1000px";
          x.style.left="50%";
          // x.style.transform="translateX(-50%)";
         
          color.style.left="0px";
        }
       
    
    </script>
</body>
</html>