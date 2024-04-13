<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-register.css">
</head>
<body>
<?php
include "ccc.php";

class AReg {
    public $conn;

    public function __construct() {
        global $database;
        $this->conn = $database->db;
    }

    public function aSignup() {
        if (isset($_POST["asignup"])) {
            if (empty($_POST["aname"]) || empty($_POST["apassword"])) {
                $message = '<label>All fields are required</label>';
            } else {
                $query = "SELECT * FROM admina WHERE aname=:aname";
                $result = $this->conn->prepare($query);
                $result->execute(array('aname' => $_POST["aname"]));
                $count = $result->rowCount();

                if ($count > 0) {
                    echo "Username already exists";
                } else {
                    $sql = "INSERT INTO `admina` (aid, aname, aemail, apassword) VALUES (NULL, :aname, :aemail, :apassword)";
                    $sqlresult = $this->conn->prepare($sql);
                    $sqlresult->execute(array(
                        "aname" => $_POST["aname"],
                        "aemail" => $_POST["aemail"],
                        "apassword" => $_POST["apassword"]
                    ));
                    header('location:index.php');
                }
            }
        }
    }
}

$areg = new AReg();
$areg->aSignup();
?>

    <div class="main">
        <div class="form-wrapper">
            <h1>Admin Register</h1>
        <form action=""method='POST'>
            <input type="email"placeholder="Email"Required name='aemail'>
            <input type="text"placeholder="Username"Required name='aname'>
            <input type="password"placeholder="Password"Required name='apassword'>
            <input type="password"placeholder="Confirm Password"Required>
            <input id="submit" name='asignup'type="submit"value="Submit">
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