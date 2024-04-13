<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="order.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require "ccc.php";
  include "nav.php"; ?><br><br><br>
    <div class="order-wrap">
    <div class="order"><br>
        <h1>My Orders</h1>
        <span id="span">View and edit all your pending, delivered and returns order here.</span>
        <div class="orderbox">
        <?php
class Orderfetch {
  public $conn;
    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function Orderfetch() {
        if (isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            $query = "SELECT * FROM `order` WHERE uid = :uid"; 
            $runQuery = $this->conn->prepare($query);
            $runQuery->bindParam(':uid', $uid);
            $runQuery->execute();
    
            if ($runQuery->rowCount() > 0) {
                $rows = $runQuery->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($rows as $row) {
                    $oid= $row['oid']; 
                     $select_products = $this->conn->prepare("SELECT * FROM `order`where oid=$oid");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                   while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                
 ?>          
            <div class="orderbox1">
            <div class="orderbox2">
                <img src="upload_image/<?= $fetch_products['image']; ?>" alt="">
            </div>
            <div  class="orderbox2 order-d">
                <h4><?= $fetch_products['name']; ?></h4><br>
                <p>Lorem ipsum dolor sit amet </p>
                <p>consectetur adipisicing elit.</p><br>
                <p>Rs.<span><?= $fetch_products['price']; ?></span></p>
            </div>
            <div class="orderbox2">
                <p>status</p>
                <p>processing</p>
            </div>
            <div class="orderbox2">
                <p>Delivery Expected By</p>
                <h4>24 December 2023</h4>
            </div>
        </div>

<?php
         
        }
    } 
}
} 
else {
    $smessage = "<div class='alert-wrapperc failed'>
        <p class='alert failed'>No orders for this user yet! <input id='disc' type='checkbox'></p>
        <span id='dismis' onclick='dissmiss()'>X</span>
    </div>
    
    ";
      echo $smessage;
}
}
}
}

$orderfetch = new Orderfetch();
$orderfetch->Orderfetch();
?>
</div>
</div>
</div>
     <?php include "footer.php" ?> 
</body>
</html>
</body>
</html>