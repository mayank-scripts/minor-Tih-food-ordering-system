<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-message.css">
    <link rel="stylesheet" href="message.css">
</head>
<body>
    
<?php 
session_start();
$username = '';
if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
   header('location:index.php');
   exit();
};
include "admin-nav.php";
        require "ccc.php";
?>
<?php
class deletemsg {
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function deletemsg() {
        if (isset($_POST['deletemsg'])) {
            $qu = $this->conn->prepare("SELECT `mid` FROM `contact`");
            $qu->execute();

            if ($qu->rowCount() > 0) {
                $del = $qu->fetchColumn(); 

                $deleteQuery = $this->conn->prepare("DELETE FROM `contact` WHERE mid = :del");
                $deleteQuery->bindParam(':del', $del);
                $deleteQuery->execute();
                $smessage = "<div class='alert-wrapper success'>
            <p class='alert sucess'>Message deleted successfully.</p><span id='dismis' onclick='dissmiss()'>X</span></div>";
            echo $smessage;
            }
        }
    }
}

$deletemsg = new deletemsg();
$deletemsg->deletemsg();
?>

    <div class="main">
            
        <h1>Messages</h1>
        <div class="main-wrapper">
        <input type="checkbox"id='disc'>
        <?php 
        class mfetch{
      public $conn;
      
          public function __construct() {
              global $database;
              $this->conn = $database->db;
          }
          public function mfetch() {
            $select_msg = $this->conn->prepare("SELECT * FROM `contact`");
            $select_msg->execute();
            if($select_msg->rowCount() > 0){
               while($fetch_msg = $select_msg->fetch(PDO::FETCH_ASSOC)){
    
  ?>
            <form class="orderbox"method='POST'>
            <input type="hidden" name="mid" value="<?= $fetch_msg['mid']; ?>">
         <input type="hidden" name="mname" value="<?= $fetch_msg['mname']; ?>">
         <input type="hidden" name="memail" value="<?= $fetch_msg['memail']; ?>">
         <input type="hidden" name="mmsg" value="<?= $fetch_msg['mmessage']; ?>">
                <div><p>Name :</p><span> <?= $fetch_msg['mname']; ?></span></div>
                <div><p>Email :</p><span> <?= $fetch_msg['memail']; ?></span></div>
                <div><p>Message:</p></div>
                <div class="message"><?= $fetch_msg['mmessage']; ?></div>
                <input type="submit"value='Delete'name='deletemsg'class='btn'style='border:none;border-top:2px solid black;'>
               </form>
            <?php
            }
         }
        }
      }
      $mfetch=new mfetch();
      $mfetch->mfetch();
      ?>

           
        </div>
        <br><br>
    </div>
    <script>
        
      var profileContainer=document.querySelector(".profileContainer");
      var disc=document.querySelector("#disc")
      var alert=document.querySelector(".alert-wrapper");
      var disc=document.querySelector("#disc");
      var dis=document.querySelector("#dismis");
      var cartpage=document.querySelector(".cart");
      var kart=document.querySelector("#kart");
      var passwordInputs = document.querySelectorAll('input[type="password"]');
      var showcheck=document.querySelector("#showcheck");
      var pass=document.querySelector("#forget-password");
      var user=document.querySelector("#forget-username");
      var loginBox=document.querySelector(".login-box");
      var x=document.querySelector("#login2");
      var y=document.querySelector("#singup");
      var color=document.querySelector(".login-btn-color");
      var btn = document.querySelector("#mob");
      var dropdown = document.querySelector(".dropdown");
      btn.addEventListener("click",function(){
        dropdown.classList.toggle('open');
      })
        function singup(){
          x.style.left="1000px";
          y.style.left="31px";
          color.style.left="50%";
          user.style.left="1000px";
          pass.style.left="1000px";
        }
        function login(){
          x.style.left="31px";
          y.style.left="1000px";
          color.style.left="0px";
          user.style.left="1000px";
          pass.style.left="1000px";
        }
        function logindrop(){
          loginBox.classList.toggle('active')
        }
        function toggleProfile(){
          profileContainer.classList.toggle('run')
        }
        function forgetusername(){
          x.style.left="1000px";
          y.style.left="1000px";
          user.style.left="10%";
          pass.style.left="1000px";
        }
        function forgetpassword(){
          x.style.left="1000px";
          y.style.left="1000px";
          pass.style.left="10%";
          user.style.left="1000px";
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
      function cart(){
          kart.click();
          if(kart.checked){
            cartpage.style.right="0px"
          }
          else{
            cartpage.style.right="-1000px";
          }
        }
        function dissmiss(){
          disc.click();
            if(disc.checked){
             alert.style.display='none';
            }
        }
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    
    </script>
</body>
</html>