<?php
session_start();
require_once 'Token.php';

$display_messsge = "";

if(isset($_POST['cardnumber'], $_POST['csrf_token'], $_POST['cvvnumber'], $_POST['nameoncard'])){

  $cardnumber = $_POST['cardnumber'];
  $csrf_token = $_POST['csrf_token'];
  $cvvnumber = $_POST['cvvnumber'];
  $nameoncard = $_POST['nameoncard'];

//Check whether the Account Number, Name, Amount, and csrf token fields are empty
  if(!empty($cardnumber) && !empty($nameoncard) && !empty($cvvnumber) && !empty($csrf_token))
  {
    if(Token::check($csrf_token))
    {
        //Display successfully change message
        echo "<script>alert('Bill Payment Successful..');</script>";
    }
    else if(!Token::check($csrf_token))
        //Display successfully not change message
        echo "<script>alert('Could not complete Bill payment.Give it another try... ');</script>";
    }
  }

//When user trying to find indexes without using username and password, display this message
 if(!isset($_SESSION['username']))
{
    echo "<h2 align='center'>You must log in first. <br> ";
    echo "<a href='index.php'> LOGIN </a></h2>";

}

else{
$now = time();
// checking the time now when home page starts

   if($now > $_SESSION['expire'])

   {

       session_destroy();

       echo "<h2 align='center'>Your session has expire ! <br><br>please <a href='index.php'>Login Here </a>to continue</h2>";



   }

    
else
{

?>

<html>

<head>
    <!-- <link rel="stylesheet" type="text/css" href="css/welcome.css"> -->
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/payment.css">
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/testlogin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">


    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Destroy Session after 1 minutes </title>

</head>
<style> 
body {
  background-image: url("img/2.jpeg");
}
</style>

<body>
     <!-- <div style="width: 40rem;">
        <form action="logout.php" method="GET">

            <div class="alert danger-centers alert-dark" role="alert">
                <h3 class="card-title">Hello <?php echo $_SESSION['username']; ?>..!!</h3>
                </br>
                <h5 class="mb-3">Now you can transfer your money. If you don't want to do that, click on logout link</h5>
                <button type="submit" class="btn btn-danger btn-lg btn-block">Log Out</button></br>
                 
            </div>
        </form>
    </div>   -->
       <header>
        <div class="container">
            <div id="branding">
                <!-- <h1><span class="highlight">Island</span>Express</h1> -->
            </div>
              
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
                
                
                <input type="hidden" name="csrf_token" value="<?php echo Token::generate();?>">
                
                <button type="submit" class="button_3" name = "submit">Pay now</button><br>
                <p class="pay1">or go back to <a href="home.php">Home</a></p>
            </form>
         </div>
         </section>   
  </div>
</div>
        


    </form>




    <br /><br />

    <span> </span>

    </p>

    <?php
    }
    
}   
    ?>

</body>

</html>