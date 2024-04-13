<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
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
         class Items {
          public $conn;
      
          public function __construct() {
              global $database;
              $this->conn = $database->db;
          }
      
          public function addItem() {
              if (isset($_POST["additem"])) {
                  $iname = $_POST["iname"];
                  $iprice = $_POST["iprice"];
                  $filename = $_FILES["iimage"]["name"];
                  $tempname = $_FILES["iimage"]["tmp_name"];
                  $folder =  $filename;
                  $des="../upload_image/" . $filename;
                  move_uploaded_file($tempname, $des);
                  $sql = "INSERT INTO `item` (itemid, iimage, iname, iprice) VALUES (NULL, :folder, :iname, :iprice)";
                  $sqlResult = $this->conn->prepare($sql);
                  $sqlResult->bindParam(':folder', $folder, PDO::PARAM_STR);
                  $sqlResult->bindParam(':iname', $iname, PDO::PARAM_STR);
                  $sqlResult->bindParam(':iprice', $iprice, PDO::PARAM_STR);
                  $sqlResult->execute();
              }
          }
          public function deleteitem() {
            if (isset($_POST['deleteitem'])) {
                $del=$_POST['itemidup'];
    
                    $deleteQuery = $this->conn->prepare("DELETE FROM `item` WHERE itemid = :del");
                    $deleteQuery->bindParam(':del', $del);
                    $deleteQuery->execute();
                }
            }
        
        public function updateitem() {
          if (isset($_POST['updateitem'])) {
            if (isset($_POST['itemidup'])) {
              $updateid=$_POST['itemidup'];
              $_SESSION['Updateitemid']= $updateid;
             header('Location: admin-update.php');
          }
      }
    }
  }
      $item = new Items();
      $item->addItem();
      $item->deleteitem();
      $item->updateitem()
      

   ?>
    <div class="main">
        <div class="addproduct">
            <h1>Add item</h1>
            <form method='POST'enctype="multipart/form-data" action="">
                <input type="text"name='iname'placeholder="Product Name"required>
                <input type="number"name='iprice'placeholder="Product Price"required>
                <input name='iimage' type="file"required>
                <input id="submit"name='additem' type="submit"value="Submit">
            </form>
        </div>
        <div class="content-center">
            <h1>Latest items</h1>
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

              <form class="item"method='POST'style='border:none;'>
              <input type="hidden"name='itemidup'value="<?= $fetch_products['itemid']; ?>">
              
                <div class="item-img">
                  <img src="../upload_image/<?= $fetch_products['iimage']; ?>" alt="" />
                </div>
                <div class="item-info">
                  <h2><?= $fetch_products['iname']; ?></h2>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  <h3>Rs.<?= $fetch_products['iprice']; ?></h3>
                  <div class="btn">
                  <input type="submit" name="updateitem" value="Update"style='background-color: #db4031;text-decoration: none;color: white;padding: 6px;width:40%;border-radius: 10px;margin-bottom: 4%;border:none;cursor: pointer;'>
                  <input type="submit" name="deleteitem" value="Delete"style='background-color: #db4031;text-decoration: none;color: white;padding: 7px;width:40%;border-radius: 10px;margin-bottom: 4%;border:none;cursor: pointer;'>
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
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
</body>
</html>