<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  </head>
  <body>
  <?php
include "ccc.php";
include "nav.php";

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  class Profile_update {
    public $conn;
    public $username; 
  
    public function __construct($username) {
      global $database;
      $this->conn = $database->db;
      $this->username = $username; 
    }
  
    public function updateProfile() {
      if (isset($_POST["add"])) {
        $phone = $_POST['phone'];
        $flat = $_POST['flat'];
        $build = $_POST['build'];
        $area = $_POST['area'];
        $land = $_POST['land'];
        $pin = $_POST['pin'];
        $house = $_POST['house'];
        $district = $_POST['district'];
        $address = " $flat, $build, $area, $land, $district, $house";
        $sql = "UPDATE `users` SET `phone` = :phone, `address` = :address, `pincode`=:pin WHERE `uname` = :username";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':pin', $pin, PDO::PARAM_STR);
        $statement->bindParam(':username', $this->username, PDO::PARAM_STR); 
        $statement->execute();
        $smessage = "<div class='alert-wrapperc success'>
        <p class='alert success'>Profile updated successfully. <input id='disc' type='checkbox'></p>
        <span id='dismis' onclick='dissmiss2()'>X</span>
    </div>
    
    ";
      echo $smessage;
      } 
    }
  }
  
  $Profile_update = new Profile_update($username);
  $Profile_update->updateProfile();
} else {
  $username = '';
}
?>





    <div class="body">
      <br><br><br><br><br>

        <div class="address-info">
            <div class="heading">
          <h2>Delivery information</h2>
        </div>
          <form method="POST" action="">
            <div class="half">
            <input class="half-input" name='flat' placeholder="  Flat no" type="text" required><input name='build' class="half-input"placeholder="    bulding no" type="text"required>
        </div>
            <div class="full">
            <input type="text"name='area'class=full-input placeholder="   Area name"required>
        </div>  
        <div class="full">
            <input type="text"class=full-input name='land'placeholder="   land mark"required>
        </div> 
        <div class="half">
            <input class="half-input" name='phone'placeholder="  Phone number"pattern="[0-9]{10}" type="tel"required><select name='district'class="half-input" id="nooftable"required>
                <option class="half-input" value="Kolkata">Kolkata</option>
                <option class="half-input" value="Bally">Bally</option>
                <option class="half-input" value="Hooghly">Hooghly</option>
                <option class="half-input" value="Bandel">Bandel</option>
                <option class="half-input" value="Dumdum">Dumdum</option>
            </select>
        </div>
        <div class="half">
            <input class="half-input" name='pin' placeholder="  Pin code"type="text" pattern="[0-9]{3,}"required><input class="half-input"name='house'placeholder="   House name" type="text"required>
        </div>
        <div class="submit22">
    <input type="submit" name="add" value="submit" class="submit-btn">
</div>

          </form>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
