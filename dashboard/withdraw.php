<?php
session_start();
require_once '../database/configdb.php';

$user_email = $_SESSION['email'];
$user_query = "SELECT * FROM users WHERE email = '$user_email'";
$user_result = $conn->query($user_query);
$user_data = $user_result->fetch_assoc();

if (isset($_POST['withdraw_submit'])) {
    $withdraw_amount = $_POST['withdraw_amount'];
    
    if ($user_data['balance'] >= $withdraw_amount) {
        $insert_withdrawal_query = "INSERT INTO transactions (user_id, amount, type, date) 
            VALUES ('{$user_data['id']}', '$withdraw_amount', 'withdrawal', NOW())";
        $conn->query($insert_withdrawal_query);
        
        $new_balance = $user_data['balance'] - $withdraw_amount;
        $update_balance_query = "UPDATE users SET balance = '$new_balance' WHERE id = '{$user_data['id']}'";
        $conn->query($update_balance_query);
    } else {
        echo "<script>alert('insufficient balance')</script>";
    }
}

