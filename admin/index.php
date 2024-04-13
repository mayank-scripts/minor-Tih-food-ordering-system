<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-login.css">
</head>
<body>
<?php
include("ccc.php");
session_start();

class alog{
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }
    public function alog() {
        $errorMessage = '';

if (isset($_POST["login"])) {
    if (empty($_POST["ausername"]) || empty($_POST["apassword"])) {
        $errorMessage = 'All fields are required';
    } else {
        $query = "SELECT * FROM admina WHERE aname = :ausername AND apassword = :apassword";
        $statement = $this->conn->prepare($query);
        $statement->execute([
            'ausername' => $_POST["ausername"],
            'apassword' => $_POST["apassword"]
        ]);

        $count = $statement->rowCount();

        if ($count > 0) {
            $_SESSION["username"]=$_POST["ausername"];
            if(isset($_SESSION["username"])) {
                header("Location: admin.php");
                 exit();
            }
        } else {
            $errorMessage = 'Username or password is wrong';
        }
    }
}
    }
}
$alog = new alog();
$alog->alog();

?>


    <div class="main">
        <div class="form-wrapper">
            <h1>Admin Login</h1>
        <form action=""method='POST'>
            <input type="text"placeholder="Username"required name='ausername'>
            <input type="password"placeholder="*********"required name='apassword'>
            <input id="submit" name='login'type="submit"value="Submit">
            <div class="dont">Dont have account ?<span><a href="admin-register.php">Register Now</a></span> </div>
        </form><br>
    </div>
    </div>
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
</body>
</html>