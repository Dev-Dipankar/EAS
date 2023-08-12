<?php
    session_start();
    if(isset($_SESSION['id'])){
        echo "
            <h3 class='server_error'>   
                You are already login. Please <a href='logout.php'>logout</a> first or go to <a href='/index.php'>Home</a>
            </h3>
            ";
            die();
    }  

    require_once '../database/dbconnect.php';
    // require_once '../config/utility.php';
    if($_POST){
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $q_user = "SELECT * FROM super_admin WHERE email = '$email' or username='$email' ";
        if ($result = mysqli_query($conn,$q_user)){

        }else{
            echo "".$conn->error;
        }
        if(mysqli_num_rows($result)!=0){
            $user = mysqli_fetch_array($result);
            if (password_verify($password,$user['password'])){
                if($user['status']){
                    session_start();
                    $_SESSION['id'] = $user['user_id'];
                    header("location:/index.php");
                }
                else{
                    echo "
                <h3 class='server_error'>   
                    User has been disable !!
                </h3>
                ";
                }   
            }
            else{
                // password incorrect
                echo "
                <h3 class='server_error'>   
                Incorrect password
                </h3>
                ";
            }
        }else{
            // email not register
            echo "
                <h3 class='server_error'>
                Username or email does not exists <a href='signup.php'>Register</a>
                </h3>
                ";
        }
    }
?>

<html>
    <Head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="./login.css">
    </Head>
    <Body>

        
    <form class="form">
        <p class="form-title">Login in to your account</p>
         <div class="input-container">
           <input type="email" placeholder="Enter email">
           <span>
           </span>
       </div>
       <div class="input-container">
           <input type="password" placeholder="Enter password">
         </div>
          <button type="submit" class="submit">
         Sign in
       </button>
 
       <p class="signup-link">
         No account?
         <a href="register.php">Signin</a>
       </p>
    </form>
 
    </Body>
</html>