<?php
    session_start();
    require_once 'Token.php';

    //Creating the cookie
    setcookie("name","Admin",time() + 20000 );
    
    $errorMsg="";
    $success="";

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    //Checking username and password
    if(isset($_POST['submit'])){
        if($username == "admin"){
            if($password == "admin"){
                $_SESSION['username'] = "Admin";
                $_SESSION['start']= time();
                            
                //Taking Logged In Times
                $_SESSION['expire']= $_SESSION['start'] + (1 * 5);
                header('Location: payment.php');

                $token = Token::generateToken(session_id());
                setcookie("id", session_id());
                setcookie("token", $token);
            }
            
            //Display this if enter the wrong password  
            else{
                $errorMsg = "Come on.! that's not your password!";
                $success = "";
            }
        }
            //Display this if enter the wrong username 
            else{
            $errorMsg = "Invalid Username.!!";
            $success = "";    
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Log In</title>
</head>

<body>
     <header style="margin-top:-50px">
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">IE2062-Web Security </span></h1>
            </div> 
        </div>

             <div>  
                <h2 style="margin-left: 920px;margin-top: -50px;">IT18205220 |::| Kumarasiri H.R.A.D.</h2> 
            </div>
    </header> 

    <div class="header">
        <p style = "background: border-box;border: none;text-align: center;color: white;"; class="error" >
        <?php echo $errorMsg; ?>
        </p>
        <p class="success">
        <?php echo $success; ?>
        </p>    
        <h2>Log in Here</h2>
    </div>

    <form  method="POST">

        <div class="userimagediv">
            <img class="userimage" src="../img/userlogo.png" alt="">
        </div>   

        <div class="input-group">
            <label for="">User Name or email</label>
            <input type="text" name="username" value="">
        </div>
        <div class="input-group">
            <label for="">Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="submit" class="btn">Log In</button>
            <button type="reset" name="reset" class="btn">Reset</button>
        </div>
        <div class="agree">
            <p id="para">Forgot<a href="#"> Password </a> ?</p> <br>
            <p id="para">Create an account ?<a href="#"> Sign In </a></p>
            <p id="para">Need <a href="#"> Help</a> ?</p>
        </div>
    </form>

    <div><h3 style="position: relative;top: 70px;margin-left: 465px;color: white;margin-top:-100px;
    " class="text-center text-white">Username = admin |::| Password = admin </h3><br></div>


</body>

</html>
