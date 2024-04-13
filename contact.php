<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="contact.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php require "ccc.php";
  include "nav.php"; 
        ?>
        <?php class Message {
          public $conn;
      
          public function __construct() {
              global $database;
              $this->conn = $database->db;
          }
      
          public function addMessage() {
              if (isset($_POST["send"])) {
                  $sql = "INSERT INTO `contact` (mid, mname, memail, mmessage) VALUES (NULL, :mname, :memail, :message)";
                  $sqlResult = $this->conn->prepare($sql);
      
                  
                  $sqlResult->execute(array("mname" => $_POST["mname"], "memail" => $_POST["memail"], "message" => $_POST["write_here"]));
      
                  if ($sqlResult) {
                    $smessage = "<div class='alert-wrapperc success'>
                    <p class='alert success'>Message send successfully <input id='disc' type='checkbox'></input></p><span id='dismis' onclick='dissmiss2()'>X</span></div>";
                echo $smessage;
                  } else {
                      echo "Message not sent";
                  }
              }
          }
      }
      
      $message = new Message();
      $message->addMessage();
      
  ?>
  
  <div class="contact" >
  <br><br><br>
    <h1>Contact us</h1>
    <h4 id="contactp">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed dignissimos
      tempora odio. Et recusandae velit reiciendis perspiciatis, sapiente
      eligendi modi!
    </h4>
    <div class="contact-main">
      <div class="contact-info">
        <div class="address">
          <div class="icon">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div class="address-info">
            <h3>Address</h3>
            <p>451 Tarakeswar pally Road</p>
            <p>Owantona dumdum 283749</p>
          </div>
        </div>
        <div class="email">
          <div class="icon">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="email-info">
            <h3>Email</h3>
            <p>jkshkjhs435@gmail.com</p>
          </div>
        </div>
        <div class="phone">
          <div class="icon">
            <i class="fa-solid fa-phone"></i>
          </div>
          <div class="phone-info">
            <h3>Phone</h3>
            <p>+91 9658921230</p>
          </div>
        </div>
      </div>
      <div class="contact-form">
        <form action=""method='POST'>
          <div class="input">
            <h1>Send messege</h1>
            <input type="text" name='mname' placeholder="Name" required/>
            <input type="email"name='memail' placeholder="Email"required />
            <textarea placeholder="Write something" name="write here" id="" cols="36" rows="10"required></textarea>
            <input id="submit" name='send' type="submit" value="submit"style='cursor:pointer;' />
          </div>
        </form>
      </div>
    </div>
    </div>
    
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
    
</body>
<?php include "footer.php" ?>

</html>