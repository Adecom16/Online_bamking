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
    .hidden {
    display: block;
}

#revealBalanceIcon {
    cursor: pointer;
}

</style>
<body>
    
<?php
session_start();
require_once '../database/configdb.php';

$user_email = $_SESSION['email'];
$user_query = "SELECT * FROM users WHERE email = '$user_email'";
$user_result = $conn->query($user_query);
$user_data = $user_result->fetch_assoc();

if (isset($_POST['deposit_submit'])) {
    $deposit_amount = $_POST['deposit_amount'];
    
    $insert_deposit_query = "INSERT INTO transactions (user_id, amount, type, date) 
            VALUES ('{$user_data['id']}', '$deposit_amount', 'deposit', NOW())";
    $conn->query($insert_deposit_query);
    
    $new_balance = $user_data['balance'] + $deposit_amount;
    
    $update_balance_query = "UPDATE users SET balance = '$new_balance' WHERE id = '{$user_data['id']}'";
    $conn->query($update_balance_query);
    

    $user_data['balance'] = $new_balance;
}

if (isset($_POST['withdraw_submit'])) {
    $withdraw_amount = $_POST['withdraw_amount'];
    
    if ($user_data['balance'] >= $withdraw_amount) {
        $insert_withdrawal_query = "INSERT INTO transactions (user_id, amount, type, date) 
            VALUES ('{$user_data['id']}', '$withdraw_amount', 'withdrawal', NOW())";
        $conn->query($insert_withdrawal_query);
        
        $new_balance = $user_data['balance'] - $withdraw_amount;
        
        $update_balance_query = "UPDATE users SET balance = '$new_balance' WHERE id = '{$user_data['id']}'";
        $conn->query($update_balance_query);
        
        $user_data['balance'] = $new_balance;
    } else {
        echo "<script>alert('insufficient balance')</script>";
    }
}
?>





<div id="liveAlertPlaceholder"></div>
<button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="d-flex" style="padding: 25px; width: 300px; background-color: rgb(205, 238, 221);">
       
<div> <a class="navbar-brand m-3" href="#"><img src="../asset/image/logo@2x.1dad7684.png" alt="" width="100px"></a> </div>
        <div style="padding-left: 90px; font-size: 20px;"> <span><i style="color: rgb(3, 3, 78);" class="fa fa-angle-right"></i><i style="color: #1dcf9f;" class="fa fa-angle-right"></i></span></div>
    </div>
        <button class="navbar-toggler" #="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav  mb-2 mb-lg-0" style="margin-left: 850px;">
 
        </ul>
        <div class=" d-flex">
         <div>
            <div class="dropdown">
                <button style=" color: #1dcf9f; background-color: rgb(255, 255, 255); border: none;box-shadow: 2px 1px rgba(0, 0, 0, 0.226);" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Live Mode 
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
         </div>
         <div>
            <img class="ms-4" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAT4AAACfCAMAAABX0UX9AAAAMFBMVEUBh1L///8FilUAiEwqf1gCiE/l5eXv/fgIjVgAhVAAjFAug1z9/P0Fi1LZ6eLv//ciup9sAAABuklEQVR4nO3SyXECARAEweUS7AH4761ALlRoXlkedEYvj/NIz21//Qz12rfnzKrHcl7W5f9bb5f9fhrqvV9uA5s+cOchvuV2ud6PGb3jfh3kG9H745vRO52m+JYVXwlfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpfCl8KXwpf6su3jPh9+Y4ZvePLN+G3LlN86+2yj73v/eEbGfXBe5xHem7762eo1749Z1Y9fgF2nG32nRewWgAAAABJRU5ErkJggg==" style="width: 40px; height: 25px; border-radius: 5px;" alt="">
         </div>
         <div>
            <p style="font-size: 20px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding-left: 15px;">Hi,<b><?php echo $user_data['firstname']?></b></p>
         </div>
        </div>
      </div>
    </div>
  </nav>
<section class="d-flex " style="background-color: gainsboro;" >
<div class="col-md-3" style="width: 320px; height: 100vh; background-color: rgb(205, 238, 221);">
<li class="mt-5 ms-2" style="font-size: 20px;">Transaction History</li>
</div>
<div class="col-md-9 " style="">
    <br>
    <br>
    <div class="ms-3">
       <span class="ms-2"><img src="<?php echo $user_data['path']?>" style="border-radius:50px; width:50px;" alt=""></span> <h2 style="font-size: ; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding-left: 15px;">Hello,<?php echo $user_data['firstname']?></h2>
    </div>
<div class="d-flex">
<div class="mt-5 ms-5" style=" height: 230px; width: 350px; background-color: rgb(64, 64, 228); border-radius: 15px;">
    <h4 class="mt-3 ms-4" style="color: white; position: relative; top: 0;">Conversion Rate</h4>
    <div class="mt-4 ms-4 d-flex">
    <div class="mt-5">
        <b style="font-size:20px; color:white;">18.9%</b>
        <p style="padding:3px; width:50px; border-radius:5px; background-color: white;" ></p>
    </div>
    <div class="ms-5 mt-5">
        <b style="font-size:20px; color:white;">98.9%</b>
        <p style="padding:3px; width:50px; border-radius:5px; background-color: white;" ></p>
    </div>
    </div>
</div>


<div class="mt-5 ms-5" style=" height: 230px; width: 350px;background-color: rgb(255, 255, 255); border-radius: 15px;">
    <h4 class="mt-3 ms-4" style="color: #005ce6; position: relative; top: 0;">Sales Progress <i style="color: black;" class="fa fa-shopping-cart"></i></h4>
    <div class="mt-3 ms-4" style="color: 	 #005ce6;">
    <p style="font-size:20px;">Marketplace Sales Chart</p>

    <p class="mt-5" style="font-size:30px; font-weight:bold;">
        +5.00 <span style="font-size:10px;">(This Month)</span>
    </p>
    </div>
</div>
<div class="mt-5 ms-5" style=" height: 230px; width: 350px; background-color: #1dcf9f; border-radius: 15px;">
    <h4 class="mt-3 ms-4" style="color: #ffffff; position: relative; top: 0;">Balance <i style="color: black;" class="fa fa-wallet"></i></h4>
    <i class="ms-4">Your current account balance <i id="revealAmountIcon" class="fa fa-eye"></i></i>
    <div class="containe">
        <h3 class="ms-4 mt-4"><span id="hiddenAmount" class="hidden">****</span></h3>
    </div>
    <h2></h2>

</div>

</div>
<br>
<br>
<div class="ms-5 d-flex justify-content-evenly">
<div>
    <h3>Deposit </h3>
    <form method="post">
        <input size="31" style="border: none; padding: 7px; outline: none;"  type="text" name="deposit_amount" placeholder="Amount"><br>
        <button class="mt-1" style="width: 275px; font-size: 18px; padding: 7px; border: none; background-color: #1dcf9f;" type="submit" name="deposit_submit">Deposit</button>
    </form>
</div>
<div>
    <h3>Withdraw </h3>
    <form method="post">
        <input size="31" style="border: none; padding: 7px; outline: none;" type="text" name="withdraw_amount" placeholder="Amount"><br>
        <button class="mt-1" style="width: 275px; font-size: 18px; padding: 7px; border: none; background-color: #1dcf9f;" type="submit" name="withdraw_submit">Withdraw</button>
    </form>
</div>
</div>

<br>
<br>
<div class="d-flex justify-content-center">
<!-- <img src="../asset/AfraidUnhappyAstarte-max-1mb.gif" alt=""> -->

</div>
</div>


</section>
<section>

</section>


<script>


var alertPlaceholder = document.getElementById('liveAlertPlaceholder')
var alertTrigger = document.getElementById('liveAlertBtn')

function alert(message, type) {
  var wrapper = document.createElement('div')
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

  alertPlaceholder.append(wrapper)
}

if (alertTrigger) {
  alertTrigger.addEventListener('click', function () {
    alert('Nice, you triggered this alert message!', 'success')
  })
}
    // Get references to the elements
const hiddenAmount = document.getElementById('hiddenAmount');
const revealAmountIcon = document.getElementById('revealAmountIcon');

// Add a click event listener to the reveal icon
revealAmountIcon.addEventListener('click', function() {
    // Toggle the 'hidden' class to show/hide the amount
    hiddenAmount.classList.toggle('hidden');
    
    // Replace the asterisks with the actual amount
    if (!hiddenAmount.classList.contains('hidden')) {
        hiddenAmount.textContent = '₦<?php echo $user_data['balance']?>.00';
    } else {
        hiddenAmount.textContent = '****';
    }
});

</script>

    <script src="../BS-FILES/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/script.js"></script>
</body>
</html>