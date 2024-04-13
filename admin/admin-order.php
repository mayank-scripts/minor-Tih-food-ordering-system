<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-order.css">
    <link rel="stylesheet" href="message.css">
</head>
<body>
    <?php 
    include("ccc.php");
    include("admin-nav.php");
    
session_start();
$username = '';
if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
   header('location:index.php');
   exit();
};?>
    <?php
class delete{
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }
    public function delete(){
        if (isset($_POST['delete'])) {
            $itemIdToDelete = $_POST['orderid'];
            $deleteQuery = $this->conn->prepare("DELETE FROM `order` WHERE oid = :oid");
            $deleteQuery->bindParam(':oid', $itemIdToDelete);
            if ($deleteQuery->execute()) {
                $smessage = "<div class='alert-wrapper success'>
                <p class='alert success'>Order deleted successfully. <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
                echo $smessage;
            } else {
                $smessage = "<div class='alert-wrapper success'>
                <p class='alert success'>Order not deleted successfully. <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss()'>X</span></div>";
                echo $smessage;
            }
        }
    }
}
$delete=new delete();
$delete->delete();
?>

    <div class="main">
            
        <h1>Placed orders</h1>
        <div class="main-wrapper">

        <?php
class Orderfetchadmin{
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function Orderfetchadmin() {
        $select_products = $this->conn->prepare("SELECT * FROM `order`");
        $select_products->execute();

        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                $uid=$fetch_products['uid'];
                $qur= $this->conn->prepare("SELECT * FROM `users`where uid=$uid");
                $qur->execute();
                if($qur->rowCount() > 0){
                    while($fetch_users = $qur->fetch(PDO::FETCH_ASSOC)){
?>
            <form class="orderbox"method='POST'>
                <input type="hidden"name="orderid" value="<?= $fetch_products['oid']; ?>">
                <div><p>Name : </p>&#32;<span><?php echo $fetch_users['uname']; ?></span></div>
                <div><p>Email : </p>&#32;<span> <?php echo $fetch_users['email']; ?></div>
                <div><p>Number : </p>&#32;<span><?php echo $fetch_users['phone']; ?></span></div>
                <div><p>Address : </p>&#32;<span><?php echo $fetch_users['address']; ?></span></div>
                <div><p>Pin code : </p>&#32;<span><?php echo $fetch_users['pincode']; ?></span></div>
                <div><p>Item:</p>&#32;<span><?php echo $fetch_products['name']; ?></span></div>
                <div><p>Price :</p>&#32;<span> Rs <?php echo $fetch_products['price']; ?></span></div>
                <input type="submit"value='Delete'name='delete'class='btn'style='border:none;border-top:2px solid black;'>
                </form>
<?php
            }
        } 
    }
}
}
}
$orderfetch = new Orderfetchadmin();
$orderfetch->Orderfetchadmin();
?>

        </div>
        <br><br>
    </div>
    <script src="script.js"></script>
</body>
</html>