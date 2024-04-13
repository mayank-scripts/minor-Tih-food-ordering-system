<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="newpayment.css">
</head>
<body>
<?php  include "ccc.php";
include "nav.php"

?><br><br><br>
    <div class="container">

        <form >
    
            <div class="row">
    
                <div class="col">
    
                    <h3 class="title">Products & bills </h3>
    
                    <div class="inputBox">
                        <span>full name :</span>
                        <input type="text" placeholder="Subhajit Rana">
                    </div>
                    
                       
                </div>
    
                <div class="col">
    
                    <h3 class="title">payment</h3>
    
                    <div class="inputBox">
                        <span>cards are accepted :</span><br>
                        <img src="card.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>name on card :</span>
                        <input type="text" placeholder="Subhajit Rana">
                    </div>
                    <div class="inputBox"id="inputBox">
                        <span>credit card number :</span>
                        <input type="number" placeholder="1111-2222-3333-4444">
                    </div>
                    <div class="inputBox"id="inputBox">
                        <span>exp month :</span>
                        <input type="text" placeholder="November">
                    </div>
                    
                    <div class="flex">
                        <div class="inputBox">
                            <span>exp year :</span>
                            <input type="number" placeholder="2024">
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" placeholder="1234">
                        </div>
                    </div>
                    <div class="cod">
                        <h4>outher methods</h4><br>
                        <div class="inputBox">
                            <span>CASH-ON-DELIVERY</span><br>
                            <input type="currency" placeholder="00.0$">
                        </div>
                    </div>
    
                </div>
        
            </div>
    
            <input type="submit" value="proceed to checkout" class="submit-btn">
    
        </form>
    
    </div>    
    
</body>
</html>