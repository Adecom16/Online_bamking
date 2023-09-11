<?php



session_start();
if(isset($_SESSION['email'])){
    if(isset($_SESSION['role']) && $_SESSION['role'] =='user' ){
    
    header('location:../UserDashboard/dashboard.php');
}
}
require_once '../database/configdb.php';
$shout='';
$errors = [];
$userntf = '';

if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    if (empty($email)) {
        $errors['emailErr'] = "Your email is required";
    }

    if (empty($password)) {
        $errors['passwordErr'] = "Your password is required";
    }


    $sql = "SELECT * FROM users WHERE email='$email'";
 $select= $conn->query($sql);
 if($select->num_rows > 0){
    $result = $select->fetch_assoc();
    if(strcmp($password, $result['password'])==0){
        $_SESSION['email'] = $result['email'];
        $_SESSION['role'] = $result['role'];
        if($result['role'] =='admin'){
        header('location: ../admin/index.php');
    }else{

        header('location: ../dashboard/dash.php');
    }

   
    }else{
       $userntf= "Invalid details";
    }
 }else{
    $userntf= "Invalid Email";
 }

}

$conn->close();

?>

<!-- Your HTML form here -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/style/style.css">
    <link rel="stylesheet" href="../BS-FILES/bootstrap.min.css">
    <link rel="stylesheet" href="../icon/all.min.css">
    <!-- Online Link  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Opay Online Banking</title>
</head>
<style>
</style>
<body>
<div class="login-root" >
  <div class=" d-flex">
    <div class= " container col-md-7" style=" height: 100vh; background-color: rgb(255, 255, 255);">
      <div class="container d-grid" style=" margin-left: 220px; margin-top: 200px;">
        <a href="#" rel="" class=""><img class="me-5"  src="../asset/image/logo@2x.1dad7684.png" alt="" width="110px"></a>

        <span class="" style="font-size: 17px; padding-top: 7px;">LOGIN TO <b>OPAY DASHBOARD</b></span>
      </div>
        
<div style="margin-left: 220px;">
  <form method="post" id="stripe-login">
    <p><?php echo $shout?></p>
    <p style="color:red;"><?php echo $userntf?></p>
    <div class="field padding-bottom--24">
      <label for="email" style="color: rgb(165, 164, 164);">Email Address</label><br>
      <div class="d-flex">
        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fa fa-envelope" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
        <input type="email" size="44" name="email"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;">
      </div>
        <p style="color: red;"><?php echo array_key_exists('emailErr',$errors)? $errors['emailErr']: " "?></p>
    </div>
    <div class="field padding-bottom--24">
      <div class="">
        <label for="password" style="color: rgb(165, 164, 164);">Password</label><span style="padding-left: 220px;"><a style="text-decoration: none; color: #1dcf9f; font-size: 13px;" href="">Forgot password?</a></span><br>
      </div>
      <div class="d-flex">
        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fas fa-lock" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
        <input type="password" size="40" name="password"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0; border-bottom-right-radius:0; border-top-right-radius:0; border-left: none; border-right: none;">
        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;"><i class="fas fa-eye" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
      </div>
        <p style="color: red;"><?php echo array_key_exists('passwordErr',$errors)? $errors['passwordErr']: " "?></p>
    </div>
    <div class="" >
      <input size="44" type="submit" name="submit" value="Log In" style="padding: 9px; margin-top: 10px; width: 400px; border: none; color: white; background-color: #1dcf9f; border-radius: 5px;">
    </div>
    <div class="field">
      <span style="font-size: 13px; padding-top: 8px;">New to Opay dashboard?<a href="./signup.php" style="text-decoration: none; color: #1dcf9f;">Sign Up</a></span>
    </div>
</form>
</div>


      
   </div>

  <div class="col-md-5" style="background-image: url(../asset/image/registerBg.044e791a.png); background-size: cover;">

  <div class="container " style="height: 70vh; border-radius: 30px; width: 430px; margin-top: 125px; background-color: rgba(17,35,61,.5); color: #fff;">
                <div style="margin-top: 12px;">
                  <img class=" ms-4" style="margin-top: 50px;" src="../asset/logo.png" width="30%" alt="">
                <span class="" style="    width: 66px; height: 2px; background-color: white; position: absolute; left: 1080px; bottom: 520px;" ></span>
                </div>
                <br>

                <p class="ms-4" style="padding: 24px 0 8px; font-size: 14px;">Get a smart tool to boost your business with <br>
                  <span style="padding-bottom: 20px;font-weight: bold; font-size: 20px;">Higher Efficiency</span>
                </p>
                
                <p class="ms-4" style="font-size: 14px;">Join 500+ Thousands of businesses using OPay <br> around the world</p>
                <br>
                <button class="" style="margin-left: 100px; width: 152px; height: 40px; border-radius: 40px; background-color: #1dce9f; font-size: 16px; border: none; color: #ffffff;"><i class="fa fa-download"></i> Download</button><br><br>
                <img style="margin-left: 125px;" src="../asset/image/download.png" width="30%" alt="">
            </div>
    </div>
  </div>
    
    <script src="../BS-FILES/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/script.js"></script>
</body>
</html>