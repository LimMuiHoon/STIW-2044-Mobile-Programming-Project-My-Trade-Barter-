<?php
error_reporting(0);
include_once ("dbconnect.php");
$email = $_POST['email'];
$sqls = "SELECT * FROM USER WHERE EMAIL = '$email' AND VERIFY ='1'";

//function randompassword($chars)
//{
//   $random ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//    return substr(str_shuffle($random),0,8);
//}

//$tempass = randompassword();
$tempasssha = sha1($tempass);

$sql ="UPDATE USER SET PASSWORD='$tempasssha' WHERE EMAIL = '$email' ";
$sqls = "SELECT * FROM USER WHERE EMAIL = '$email' AND VERIFY ='1'";
$result = $conn->query($sqls);
if ($conn -> query($sql) ===TRUE && $result->num_rows > 0) {
    sendEmail($email,$tempass);
    echo "Email received. You can change the password now.";
} else {
    echo "Email is does not correct";
}

function sendEmail($useremail) {
    $to         = $useremail;
    $subject    = 'Reset Password for MyTradeBarterUser';
    $message    = 'Your Email have been verify, You can change your password now. ';
    $headers    = 'From: noreply@MyTradeBarterUser.com.my' . "\r\n" .
    'Reply-To: '.$useremail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}

?>