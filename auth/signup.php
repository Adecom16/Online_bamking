<?php
require_once '../database/configdb.php';
$shout='';
$errors = [];
$data = array(
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'phone' => '',
    'password' => '',
);

if (isset($_POST['submit'])) {

    $tmp_name=$_FILES['picture']['tmp_name'];
    $name=$_FILES['picture']['name'];
    $size=$_FILES['picture']['size'];
    $path ='../upload/' . $name;
    $pathEx=pathinfo($path, PATHINFO_EXTENSION);

//    if ($pathEx != 'jpg' && $pathEx != 'png' && $pathEx != 'jpeg' ) {
//         echo "your file must be an image";
//    }if ($size >  5000) {
//         echo "the file is to big";
//    }else{

//    }



    if (empty($_POST['firstname'])) {
        $errors['firstnameErr'] = "Your First Name is Required";
    }

    if (empty($_POST['lastname'])) {
        $errors['lastnameErr'] = "Your Last Name is Required";
    }

    if (empty($_POST['email'])) {
        $errors['emailErr'] = "Your email is Required";
    }

    if (empty($_POST['phone'])) {
        $errors['phoneErr'] = "Your Phone Number is Required";
    }

    if (empty($_POST['password'])) {
        $errors['passwordErr'] = "Your Password is Required";
    }


    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = md5($_POST["password"]);
    $date = date("Y-m-d h:i:s a");


    if(count($errors) == 0){
        if (move_uploaded_file($tmp_name, $path)) {
            // echo "upload successfully";
        //Conditional Selection
          $sql = "SELECT email FROM users WHERE email ='$email'";
          $select = mysqli_query($conn, $sql);
           if(mysqli_num_rows($select) == 0){
           $sql = "INSERT INTO users (firstname, lastname, email, phone, password, path) VALUES ('$firstname', '$lastname', '$email', '$phone', '$password', '$path')";;
         if(mysqli_query($conn,  $sql)){
           $shout= "Registration  successfully";
           header('location: ./login.php');
            exit();
         }
         else{
           echo "Something went wrong". mysqli_error($conn);
         }
       }else{
           $errors['emailErr'] ="Your email is already exist";
       }
       }else {
        echo "unable to upload file";
       }
    }
}
?>


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

<body>
                <div class="d-flex">
            <div class="col-md-7" style="">
              <div class="container d-grid" style=" margin-left: 220px; margin-top: 40px;">
                <a href="#" rel=""><img src="../asset/image/logo@2x.1dad7684.png" alt="" width="110px"></a>
                <span class="pt-2">SIGNUP TO YOUR <b>OPAY ACCOUNT</b></span>
                </div>
            <br>
                <div style="margin-left: 220px;">
                  <form method="post" id="stripe-login" enctype="multipart/form-data">
                    <p><?php echo $shout?></p>
                    <div class="field padding-bottom--24">
                      <label for="firstname">FirstName</label>
                      <br>
                      <div class="d-flex">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fa fa-user" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                        <input type="text" size="44" name="firstname"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;">
                      </div>
                      <p style="color: red;"><?php echo array_key_exists('firstnameErr',$errors)? $errors['firstnameErr']: " "?></p>
                    </div>
                    <div class="field padding-bottom--24">
                      <label for="lastname">LastName</label>
                      <br>
                      <div class="d-flex">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fa fa-user" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                        <input type="text" size="44" name="lastname"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;">
                      </div>
                      <p style="color: red;"><?php echo array_key_exists('lastnameErr',$errors)? $errors['lastnameErr']: " "?></p>
                    </div>
                    <div class="field padding-bottom--24">
                      <label for="email">Email</label>
                      <br>
                      <div class="d-flex">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fa fa-envelope" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                        <input type="email" size="44" name="email"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;">
                      </div>
                      <p style="color: red;"><?php echo array_key_exists('emailErr',$errors)? $errors['emailErr']: " "?></p>
                    </div>
                    <div class="field padding-bottom--24">
                      <div class="grid--50-50">
                        <label for="password">Password</label>
                        <br>
                      </div>
                      <div class="d-flex">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fas fa-lock" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                        <input type="password" size="40" name="password"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0; border-bottom-right-radius:0; border-top-right-radius:0; border-left: none; border-right: none;">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;"><i class="fas fa-eye" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                      </div>
                        <p style="color: red;"><?php echo array_key_exists('passwordErr',$errors)? $errors['passwordErr']: " "?></p>
                    </div>
                      <div>
                      <label for="password">Upload your Image</label><br>
                      <input type="file" name="picture">
                      </div>
                      <br>
                      
                    <div class="field padding-bottom--24">
                      <label for="phone">Phone No.</label>
                      <br>
                      <div class="d-flex">
                        <span style="border: 1px solid #1dcf9f; border-radius: 5px;padding: 9px;border-top-right-radius:0;border-bottom-right-radius:0;border-right: none;"><i class="fa fa-phone" style="color: rgb(187, 185, 185); font-size: 10px;"></i></span>
                        <input type="tel" size="44" name="phone"  style="padding: 9px; outline: none; border: 1.1px solid #1dcf9f; border-radius: 5px;border-top-left-radius:0;border-bottom-left-radius:0;border-left: none;">
                      </div>
                      <p style="color: red;"><?php echo array_key_exists('phoneErr',$errors)? $errors['phoneErr']: " "?></p>
                    </div>
                    <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                      <label for="checkbox">
                        <input type="checkbox" name="checkbox">Remeber me
                      </label>
                    </div>
                    <div class="field padding-bottom--24">
                      <input type="submit" name="submit" value="Sign Up" style="padding: 9px; margin-top: 10px; width: 400px; border: none; color: white; background-color: #1dcf9f; border-radius: 5px;">
                      
                    </div>
                    <div class="field">
                    </div>
                  </form>
                </div>
              <div class="container" style="margin-left: 300px;">
                     <span style="font-size: 13px; padding-top: 8px;">Already Have an Opay Account?<a href="./login.php" style="text-decoration: none; color: #1dcf9f;">Log In</a></span>
                <br>
                <br>
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