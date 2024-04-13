<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="nav.css">
    <style>
      .failed{
        background-color: rgb(248,215,218);
      }
      .success{
        background-color: rgb(208,231,220);
      }
      .alert-wrapper,.alert-wrapperc{
        width:100%;
        display: flex;
        align-items: center;
        position: absolute;
        top:40px;
        left: 0;
        height: 5vh;
      }
      .alert{
        width: 98%;
        text-align: center;
        font-size: larger;
      }
      #disc{
            display:none;
        }
        #dismis{
          cursor: pointer;
        }
        #mobile{
          display:none;
        }
    </style>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<?php

session_start();
class user{
  public $conn;
public function __construct(){
  global $database;
  $this ->conn=$database->db;
}
public function login() {
  if (isset($_POST["login"])) {
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
              $smessage = "<div class='alert-wrapper success'>
              <p class='alert sucess'>Accound logged in sucsessfully <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
              echo $smessage;
              
          } else {
            $fmessage = "<div class='alert-wrapper failed'>
            <p class='alert failed'>Failed account not Logged in check username or password. <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
            echo $fmessage;
          }
      }
  }
}

          
      
  


function signup(){
  if(isset($_POST["signup"]))
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
    $smessage = "<div class='alert-wrapper success'>
              <p class='alert sucess'>Accound created sucsessfully <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
              echo $smessage;
   }

    }
}
}
}
$user=new user();
$user->login();
$user->signup();
?>


<?php
// session_start();

if (isset($_SESSION['uid'])) {
    $username = $_SESSION['username'];
    $uid = $_SESSION['uid'];

    class InfoFetch {
        public $conn;

        public function __construct() {
            global $database;
            $this->conn = $database->db;
        }

        public function fetchUserInfo($uid) {
            $query = "SELECT * FROM users WHERE uid=:uid";
            $statement = $this->conn->prepare($query);
            $statement->execute(array(':uid' => $uid));
            $fetch_info = $statement->fetch(PDO::FETCH_ASSOC);

            return $fetch_info;
        }
    }

    $infoFetch = new InfoFetch();
    $userInfo = $infoFetch->fetchUserInfo($uid);


}
?>
<?php
          class Orderfav {
            public $conn;
            
            public function __construct() {
                global $database;
                $this->conn = $database->db;
                
            }
        
            public function Orderfav() {
                if (isset($_POST['orderi2'])) {
            if (isset($_SESSION['uid'])){
              $uid = $_SESSION['uid'];
              $queary ="SELECT * FROM users WHERE uid=$uid" ;
              $runqueary=$this->conn->prepare($queary);
              $runqueary->execute();
              $row = $runqueary->fetch(PDO::FETCH_ASSOC);
              if(isset($row["address"])){
              $pid = null;
              $name = $_POST['name'];
              $price = $_POST['price'];
              $image = $_POST['image'];
              $sql = "INSERT INTO `order` (`oid`, `uid`, `pid`, `name`, `price`, `image`) VALUES (NULL, :uid, :pid, :name, :price, :image);";
              $statement = $this->conn->prepare($sql);
              $statement->bindParam(':uid', $uid, PDO::PARAM_STR);
              $statement->bindParam(':pid', $pid, PDO::PARAM_STR);
              $statement->bindParam(':name', $name, PDO::PARAM_STR);
              $statement->bindParam(':price', $price, PDO::PARAM_STR);
              $statement->bindParam(':image', $image, PDO::PARAM_STR);
              $statement->execute();
             
              }
              
              } 
            }
          }
        }
        $Orderfav = new Orderfav();
          $Orderfav->Orderfav();
          ?>
 

<header>
      <nav>
        <img src="logo.png" alt="" />
        <ul>  
          <li><a href="index.php">Home</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="order.php">Order</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="contact.php">Contact us</a></li>
        </ul>
        <div class="icon">
          <i id="magni" class="fa-solid fa-magnifying-glass fa-sm"></i>
          <i class="fa-solid fa-user"onclick="toggleProfile()"></i>
          <i class="fa-solid fa-heart"onclick="cart()"></i>
          <button  id="login-nav-btn" class="login-btn" onclick="logindrop()">Login</button>
          <i id="mob" class="fa-solid fa-bars" id="icon"onclick="dropdown()"></i>
          <input type="checkbox"id='mobile'>
        </div>
        <input type="checkbox" id="kart">
      </nav>
      <div class="dropdown">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="order.php">Order</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="contact.php">Contact us</a></li>
          <li><a href="login.php">Login/Singup</a></li>
        </ul>
      </div>
      <div  class="login-box">
        <div class="login-btn-box">
          <div class="login-btn-color"></div>
          <button  class="login-box-btn" onclick="login()">Login</button><button class="login-box-btn" onclick="singup()">Signup</button>
        </div>
        <div class="social-icon">
          <i class="fa-brands fa-facebook "></i>
          <i class="fa-brands fa-google "></i>
          <i class="fa-brands fa-instagram"></i>
        </div>
        <input id="showcheck" type="checkbox">
        <form id="login2" method='POST' class="input-group" action="">
              <h1 class="login-heading">Login</h1>
            <input class="input2" name='username' type="text" placeholder=" Username"required>
            <div class="password-eye">
            <input  class="input2"name='password' type="password" placeholder=" password"required pattern=".{8,}">
            <span  onclick="passwordinput()"class="eye"><img width="35" height="30" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
          </div>
            <input type="checkbox" class="check-box"><span>Remember password</span>
            <input class="submit-login"name='login' type="submit"value="Submit">
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
        <input class="submit"name='signup' type="submit"value="Submit">
    </form>
    <form id="forget-username" class="input-group" action="">
      <h1 class="forget-heading">Forget username</h1>
    <input class="singup-input" type="email" placeholder=" Email"required>
    <div class="password-eye">
    <input class="singup-input" type="password" placeholder=" password"required>
    <span onclick="passwordinput()" class="eye"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
  </div>
  <input class="singup-input" type="text" placeholder=" New Username"required>
    <input class="submit-login" type="submit"value="Submit">
</form>
<form id="forget-password"class="input-group" action="">
  <h1 class="forget-heading">Forget password</h1>
<input class="singup-input" type="text" placeholder=" Username"required>
<input class="singup-input" type="email" placeholder=" Email"required>
<div class="password-eye">
    <input class="singup-input" type="password" placeholder=" Old password"required>
    <span  onclick="passwordinput()" class="eye"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-regular/48/wi-fi-fair.png" alt="wi-fi-fair"/></span>
  </div>
<input class="singup-input" type="password" placeholder=" New Password"required>
<input class="submit" type="submit"value="Submit">
</form>
        <div class="login-box-link">
        <a onclick="forgetusername()">Forget Username ?</a>
        <a onclick="forgetpassword()">Forget password ?</a>
      </div>
      </div>

      <div  class="profileContainer">
      <div class="profile-info">
            <div class="singup-info">
                <form action="">
                    <div class="img-div">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </form>
                 <h2> <?php if (isset($_SESSION['uid'])) {
                echo $username;}
                else{
                  echo "Name";
                }?></h2> 
                <p><?php if (isset($_SESSION['uid'])) {
                echo $userInfo['email'];}
                else{
                  echo "Email";
                }
                ?></p>
                
            </div><br>
            <div class="address-demo">
              <h3>Address</h3><br>
              <p><?php if (isset($_SESSION['uid'])) {
                echo $userInfo['address'];
                echo"<br>";
                echo $userInfo['pincode'];}
                else{
                  echo "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, numquam!";
                }
                ?></p>
            </div>
            <div class="links">
                <li ><i  class="fa-solid fa-truck"></i>&nbsp;<a href="profile.php">Delivery information</a></li>
                <li><i class="fa-solid fa-right-from-bracket">&nbsp;&nbsp;</i><a href="logout.php">Logout</a></li>
            </div>
        </div>
        </div>
                 

      <div class="cart">
          <div class="cross"><i class="fa-solid fa-x"onclick="cart()"></i></div>
          <div class="h1"><h1>Favourite</h1></div>
              
          <?php
          
class favfetch {
  public $conn;
    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function favfetch() {
        if (isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            $query = "SELECT * FROM `fav` WHERE uid = :uid"; 
            $runQuery = $this->conn->prepare($query);
            $runQuery->bindParam(':uid', $uid);
            $runQuery->execute();
    
            if ($runQuery->rowCount() > 0) {
                $rows = $runQuery->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($rows as $row) {
                    $favid= $row['favid']; 
                     $select_products = $this->conn->prepare("SELECT * FROM `fav`where favid=$favid");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                   while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                
 ?>
          <form action=""class='item-cover' method='POST'>
          <input type="hidden" name="name" value="<?= $fetch_products['favname']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['favprice']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['favimage']; ?>">
           <div class="item-cart" >
            
           
          <div class="item-img " style='margin: 10% 3%;width: 80%;height: 113px;border-radius: 10px;'>
          <img src="upload_image/<?= $fetch_products['favimage']; ?>" alt="">
          </div>
          <div class="item-info">
            <h2><?= $fetch_products['favname']; ?></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <h3>Rs.<?= $fetch_products['favprice']; ?></h3>
            <div class="menu-link">
            <div class="add">
                <i class="fa-solid fa-cart-shopping"></i>
              </div>
              <input type="submit" value="Order now" name='orderi2' style='font-size:13px;padding:8px;border-radius: 5px;border:none;background:#db4031;color:white;font-weight:600;cursor:pointer;'>
              <div class="add">
              <i class="fa-solid fa-plus"></i>
              </div>
              </div>
          </div>
        </div>
           </form>
          <?php
         
        }
    } 
}
} 

}
}
}

$favfetch = new favfetch();
$favfetch->favfetch();
?>
          
          <br><br>
    </div>
    </header>
    
    <script src="script.js"></script>
    
</body>
</html>