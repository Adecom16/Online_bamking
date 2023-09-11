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
}

