<?php
session_start();
require_once 'Token.php';

$display_messsge = "";

if(isset($_POST['cardnumber'], $_POST['csrf_token'], $_POST['cvvnumber'], $_POST['nameoncard'])){

  $cardnumber = $_POST['cardnumber'];
  $csrf_token = $_POST['csrf_token'];
  $cvvnumber = $_POST['cvvnumber'];
  $nameoncard = $_POST['nameoncard'];

  //Check whether the fields are empty
  if(!empty($cardnumber) && !empty($nameoncard) && !empty($cvvnumber) && !empty($csrf_token)){
    if(Token::check($csrf_token)){
        //Display Payment successfully msg
        echo "<script>alert('Bill Payment Successful..');</script>";
    }
    else if(!Token::check($csrf_token))
        //Display not complete Bill payment msg
        echo "<script>alert('Error occured.!!Give it another try... ');</script>";
    }
}

//display msg When user trying to find indexes without valid credentials  
if(!isset($_SESSION['username'])){
        echo "<h2 align='center'>You must log in first. <br> ";
        echo "<a href='index.php'> LOGIN </a></h2>";
}

else{
    $now = time();
    // checking the current time 
    if($now > $_SESSION['expire']){
           session_destroy();
           echo "<h2 align='center'>Your session has expire ! <br><br>Click <a href='index.php'>Here </a> to login again</h2>";
    }
      
    else{

?>

<html>

<head>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/payment.css">
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Session_Will_Destroy</title>

</head>

<body>            
       <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">IE2062-Web Security </span></h1>
            </div>
              
        </div>
            <div>
                <form action="logout.php" method="GET">  
                <h2 style="margin-left: 980px;margin-top: -50px;">Hello <?php  echo $_SESSION['username']; ?>
                </h2> 
                <button type="submit" class="button_2" style="margin-left: 1180px;margin-bottom: -21px;margin-top: -47px;">Log Out</button>
                </form>
            </div>

         </header>

    <section id="showcase">
        <div class="billing">
            <?php
                if($_POST){
                    $errors = array();
                    if(empty($_POST['cardnumber'])){
                        $errors['cardnumber'] = "Enter the card number";
                    }
                    if(empty($_POST['nameoncard'])){
                        $errors['nameoncard'] = "Enter the name on card";
                    }
                    if(empty($_POST['cvvnumber'])){
                        $errors['cvvnumber'] = "Enter the CVV number";
                    }
                    
                    if(count($errors) == 0){
                        header ("location: paysuccess.php");
                        exit();
                    }
                }
            ?>

            <form method="POST">
                <h1 class="bill">Billing details</h1>
                <ul class="image1">
                    <li>Card type:<input type="radio" name="cardtype" value = "1"> <img class="image2" src="../img/visa.png" alt=""></li>
                    <li><input type="radio" name="cardtype" value = "2"> <img class="image2" src="../img/mastercard.png" alt=""></li>
                    <li><input type="radio" name="cardtype" value = "3"> <img class="image2" src="../img/american.png" alt=""></li>
                    <li><input type="radio" name="cardtype" value = "4"> <img class="image2" src="../img/paypal.png" alt=""></li>
                </ul>
                <p> Card number:<input id="card" class="number" type="text" name="cardnumber"></p><br>
                <p2 calss = "error"><?php
                    if(isset($errors['cardnumber'])){
                        echo $errors['cardnumber'];
                    }
                    ?>
                </p2><br>
                <p> Name on card:<input id="name" class="number" type="text" name="nameoncard"></p><br>
                <p2 calss = "error"><?php
                    if(isset($errors['nameoncard'])){
                        echo $errors['nameoncard'];
                    }
                    ?>
                </p2><br>
                <p> CVV number:<input id="cvv" class="number" type="text" name="cvvnumber"></p><br>
                <p2 calss = "error"><?php
                    if(isset($errors['cvvnumber'])){
                        echo $errors['cvvnumber'];
                    }
                    ?>
                </p2><br>
                <input type="hidden" name="csrf_token" value="<?php echo Token::generateToken();?>">
                
                <button type="submit" class="button_3" name = "submit">Pay now</button><br>
                <p class="pay1">or go back to <a href="#">Home</a></p>
            </form>
         </div>
         </section>   
  </div>
</div>
        
    <?php
    }
    
}   
    ?>

</body>

</html>