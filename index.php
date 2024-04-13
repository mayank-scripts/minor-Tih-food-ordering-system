<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />

</head>


<body>

  <?php 
    require "ccc.php";
    include "nav.php" ;?>
    <div class="main">
    <div class="left">
      <p>Best in cafeu</p>
      <h1>BBQ chicken <span> Salad </span> with creamy Avocado</h1>
      <p id="lorem">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores
        voluptatum odio aut expedita, nam alias sed libero eveniet qui atque?
      </p>
      <div><a href="">Order Now</a></div>
    </div>
    <div class="right">
      <img src="baner.png" alt="" />
    </div>
  </div>
 
  <?php
class Order {
  public $conn;
    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

public function add_order() {
if (isset($_POST['orderi'])) {
  if (isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $queary ="SELECT * FROM users WHERE uid=$uid" ;
    $runqueary=$this->conn->prepare($queary);
    $runqueary->execute();
    $row = $runqueary->fetch(PDO::FETCH_ASSOC);
    if(isset($row["address"])){
    $pid = $_POST['pid'];
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
    $smessage = "<div class='alert-wrapperc success'>
    <p class='alert success'>Order completed successfully <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss2()'>X</span></div>";
echo $smessage;

    }
    else{
      $smessage = "<div class='alert-wrapperc failed'>
      <p class='alert failed'>Please provide the delivery information in profile section<input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss2()'>X</span></div> ";
      echo $smessage;
    }
    
    } 
   else {
    $smessage = "<div class='alert-wrapper failed'>
    <p class='alert failed'>You have to login first <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
    echo $smessage;
    }
  }
}
}
$order = new Order();
$order->add_order();
?>
<?php
class fav{
  public $conn;
    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }
    public function fav() {
      if(isset($_POST["fav"])){
        if (isset($_SESSION['uid'])){
          $uid = $_SESSION['uid'];
          $pname=$_POST['name'];
          $pimage=$_POST['image'];
          $pprice=$_POST['price'];
          $sql = "INSERT INTO `fav` (favid,uid, favimage, favname, favprice) VALUES (NULL,:uid, :favimage, :favname, :favprice)";
          $sqlResult = $this->conn->prepare($sql);
          $sqlResult->bindParam(':uid', $uid, PDO::PARAM_STR);
          $sqlResult->bindParam(':favimage', $pimage, PDO::PARAM_STR);
          $sqlResult->bindParam(':favname', $pname, PDO::PARAM_STR);
          $sqlResult->bindParam(':favprice', $pprice, PDO::PARAM_STR);
          $sqlResult->execute();
}
else{
  $smessage = "<div class='alert-wrapper failed'>
    <p class='alert failed'>You have to login first</p><span id='dismis' onclick='dissmiss()'>X</span></div>";
    echo $smessage;
}
}
}
}
$fav=new fav();
$fav->fav();  
?>
  <div class="wrapper">
    <div class="content-center">
      <h1 style='color:#DB4031;border-bottom:2px solid #DB4031 ;'>Latest items</h1>
      <div class="content">
        
        <?php class itemfetch{
      public $conn;
      
          public function __construct() {
              global $database;
              $this->conn = $database->db;
          }
          public function itemfetch() {
            $select_products = $this->conn->prepare("SELECT * FROM `item`");
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
    
  ?>
  <!-- id='myForm' -->
        <form  class="item"method='POST'>
        <input type="hidden" name="pid" value="<?= $fetch_products['itemid']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['iname']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['iprice']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['iimage']; ?>">
          <div class="item-img">
            <img src="upload_image/<?= $fetch_products['iimage']; ?>" alt="">
          </div>
          <div class="item-info">
            
            <h2><?= $fetch_products['iname'];?></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <h3>Rs.<?= $fetch_products['iprice']; ?></h3>
            <div class="menu-link">
            <div class="add">
                <input class='last' type="submit"name='fav'value='&#10084;'>

 
            </div>
              <input class='lastorder' type="submit"value="Order now"name='orderi'>
              <div class="add">
              <i class="fa-solid fa-plus"></i>
              </div>
              </div>
          </div>
        </form>
<?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
        }
      }
      $itemfetch=new itemfetch();
      $itemfetch->itemfetch();
      ?>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer">
      <div class="footer-tag">
        <h2>Location</h2>
        <p>USA</p>
        <p>India</p>
        <p>Japan</p>
        <p>Italy</p>
        <p>Bangladesh</p>
      </div>
      <div class="footer-tag">
        <h2>Quick link</h2>
        <p>Home</p>
        <p>Menu</p>
        <p>Order</p>
        <p>About us</p>
        <p>Contact us</p>
      </div>
      <div class="footer-tag">
        <h2>Contact</h2>
        <p>+914523903</p>
        <p>+919034853</p>
        <p>noraghi45@gamil.com</p>
        <p>sufihe34@gamil.com</p>
      </div>
      <div class="footer-tag">
        <h2>Our service</h2>
        <p>Fast Delivery</p>
        <p>Easy payments</p>
        <p>24 x 7 Service</p>
      </div>
    </div>
    <p>Copyright @ 2023 By Rupam dey</p>
  </footer>
  <script src="script.js"></script>
  
</body>

</html>
