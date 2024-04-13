<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-update.css">
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
include "ccc.php";?>
    <div class="main">
        <div class="addproduct">
            <h1>Update item</h1>
            
            
<?php
class updateItems {
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function updateItems() {
        if (isset($_SESSION['Updateitemid'])) {
            $Updateitemid = $_SESSION['Updateitemid'];
            $runq = $this->conn->prepare("SELECT * FROM `item` WHERE `itemid` = :Updateitemid");
            $runq->bindParam(':Updateitemid', $Updateitemid);
            $runq->execute();

            if ($runq->rowCount() > 0) {
                while ($fetch_products = $runq->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="img">
                    <img src="../upload_image/<?= $fetch_products['iimage']; ?>" alt="" />
                    </div>
                    <?php
                }
            } else {
                $Updateitemid = '';
            }
        }
    }
    function updateform() {
        if (isset($_POST['updateform'])) {
            $updatename = $_POST['update-name'];
            $updateprice = $_POST['update-price'];
            $filename = $_FILES["upimg"]["name"];
            $tempname = $_FILES["upimg"]["tmp_name"];
            $folder =  $filename;
            $des="../upload_image/" . $filename;
            move_uploaded_file($tempname, $des);
            if (isset($_SESSION['Updateitemid'])) {
                $Updateitemid = $_SESSION['Updateitemid'];
                $runq = $this->conn->prepare("UPDATE `item` SET `iimage` = :folder, `iname` = :updatename, `iprice` = :updateprice WHERE `item`.`itemid` = :Updateitemid");
                $runq->bindParam(':Updateitemid', $Updateitemid);
                $runq->bindParam(':updatename', $updatename);
                $runq->bindParam(':folder', $folder);
                $runq->bindParam(':updateprice', $updateprice);
                $runq->execute();
            }
        }
    }
    
}
$updateItems = new updateItems();
$updateItems->updateItems();
$updateItems->updateform();
?> 

                
            
            <form action="" method='POST'enctype="multipart/form-data">
                <input type="text"placeholder="Product Name"required name='update-name'>
                <input type="number"placeholder="Product Price"required name='update-price'>
                <input  type="file" name='upimg'>
                <input id="submit"name='updateform' type="submit"value="submit">
            </form><br><br>
        </div>
</body>
</html>